<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Helper
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Helper\Controller;

use Modules\Media\Models\Collection;
use Modules\Media\Models\CollectionMapper;
use Modules\Media\Models\NullCollection;
use Modules\Media\Models\MediaMapper;
use Modules\Helper\Models\PermissionState;
use Modules\Helper\Models\NullReport;
use Modules\Helper\Models\Report;
use Modules\Helper\Models\ReportMapper;
use Modules\Helper\Models\NullTemplate;
use Modules\Helper\Models\Template;
use Modules\Helper\Models\TemplateDataType;
use Modules\Helper\Models\TemplateMapper;

use phpOMS\Account\PermissionType;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\System\MimeType;
use phpOMS\Utils\IO\Csv\CsvDatabaseMapper;
use phpOMS\Utils\IO\Excel\ExcelDatabaseMapper;
use phpOMS\Utils\Parser\Markdown\Markdown;
use phpOMS\Utils\StringUtils;
use phpOMS\Views\View;

/**
 * TODO: Implement auto sqlite generator on upload
 */

/**
 * Helper controller class.
 *
 * @package    Modules\Helper
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.
 * @link       http://orange-managementcom
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class ApiController extends Controller
{

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiHelperExport(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        // todo: check permission here

        $template  = TemplateMapper::get((int) $request->getData('id'));
        $accountId = $request->getHeader()->getAccount();

        if ($template->getCreatedBy()->getId() !== $accountId // todo: also check if report createdBy
            && !$this->app->accountManager->get($accountId)->hasPermission(
            PermissionType::READ, $this->app->orgId, null, self::MODULE_NAME, PermissionState::REPORT, $template->getId())
        ) {
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
        }

        $view = $this->createView($template, $request, $response);
        $this->setHelperResponseHeader($view, $template->getName(), $request, $response);
        $view->setData('path', __DIR__ . '/../../../');

        if ($request->getData('download') !== null) {
            $response->getHeader()->setDownloadable($template->getName(), (string) $request->getData('type'));
        }

        $response->set('export', $view);
    }

    /**
     * Set header for report/template
     *
     * @param View             $view     Template view
     * @param string           $name     Template name
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    private function setHelperResponseHeader(View $view, string $name, RequestAbstract $request, ResponseAbstract $response) : void
    {
        switch ($request->getData('type')) {
            case 'pdf':
                $response->getHeader()->set('Content-Type', MimeType::M_PDF, true);
                break;
            case 'csv':
                $response->getHeader()->set('Content-Type', MimeType::M_CONF, true);
                break;
            case 'xlsx':
                $response->getHeader()->set(
                    'Content-disposition', 'attachment; filename="'
                    . $name . '.'
                    . ((string) $request->getData('type'))
                    . '"'
                , true);
                $response->getHeader()->set('Content-Type', MimeType::M_XLSX, true);

                $response->getHeader()->set('Content-Type', MimeType::M_XLSX, true);
                break;
            case 'json':
                $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
                break;
            default:
                $response->getHeader()->set('Content-Type', 'text/html; charset=utf-8');
                // todo: use html template here instead which uses the tcoll/template!!!
                $view->setTemplate('/' . \substr($view->getData('tcoll')['template']->getPath(), 0, -8));
        }
    }

    /**
     * Create view from template
     *
     * @param Template         $template Template to create view from
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     *
     * @return View
     *
     * @api
     *
     * @since  1.0.0
     */
    private function createView(Template $template, RequestAbstract $request, ResponseAbstract $response) : View
    {
        $tcoll = [];
        $files = $template->getSource()->getSources();

        foreach ($files as $tMedia) {
            $lowerPath = \strtolower($tMedia->getPath());

            if (StringUtils::endsWith($lowerPath, '.lang.php')) {
                $language                 = \explode('.', $lowerPath)[0];
                $tcoll['lang'][$language] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.xlsx.php')
                || StringUtils::endsWith($lowerPath, '.xls.php')
            ) {
                $tcoll['excel'][$tMedia->getName()] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.docx.php')
                || StringUtils::endsWith($lowerPath, '.doc.php')
            ) {
                $tcoll['word'][$tMedia->getName()] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.pptx.php')
                || StringUtils::endsWith($lowerPath, '.ppt.php')
            ) {
                $tcoll['powerpoint'][$tMedia->getName()] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.pdf.php')) {
                $tcoll['pdf'][$tMedia->getName()] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.csv.php')) {
                $tcoll['csv'][$tMedia->getName()] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.json.php')) {
                $tcoll['json'][$tMedia->getName()] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.tpl.php')) {
                $tcoll['template'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.css')) {
                $tcoll['css'][$tMedia->getName()] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.js')) {
                $tcoll['js'][$tMedia->getName()] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.sqlite') || StringUtils::endsWith($lowerPath, '.db')) {
                $tcoll['db'][$tMedia->getName()] = $tMedia;
            } else {
                $tcoll['other'][$tMedia->getName()] = $tMedia;
            }
        }

        $view = new View($this->app, $request, $response);
        if (!$template->isStandalone()) {
            $report = ReportMapper::getNewest(1,
                (new Builder($this->app->dbPool->get()))->where('helper_report.helper_report_template', '=', $template->getId())
            );

            $rcoll  = [];
            $report = \end($report);
            $report = $report === false ? new NullReport() : $report;

            if (!($report instanceof NullReport)) {
                $files = $report->getSource()->getSources();

                foreach ($files as $media) {
                    $rcoll[$media->getName() . '.' . $media->getExtension()] = $media;
                }
            }

            $view->addData('report', $report);
            $view->addData('rcoll', $rcoll);
        }

        $view->addData('tcoll', $tcoll);
        $view->addData('lang', $request->getData('lang') ?? $request->getHeader()->getL11n()->getLanguage());
        $view->addData('template', $template);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTemplateCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $collection = $this->createMediaCollectionFromRequest($request);
        $template   = $this->createTemplateFromRequest($request, $collection->getId());

        $this->createModel($request, $template, TemplateMapper::class, 'template');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Template', 'Template successfully created', $template);
    }

    /**
     * Method to create media collection from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Collection
     *
     * @since  1.0.0
     */
    private function createMediaCollectionFromRequest(RequestAbstract $request) : Collection
    {
        if ($request->getData('media-list') === null) {
            return new NullCollection();
        }

        $files = $request->getData('media-list');
        if (\is_array($files)) {
            if (\stripos($files[0] ?? '', '[') === 0) {
                $files = \array_merge($files, \json_decode($files[0], true));
                unset($files[0]);
            } elseif ($files[0] === '') {
                unset($files[0]);
            }
        } elseif (\is_string($files)) {
            $files = \json_decode($files, true);
        }

        // TODO: make sure this user has permissions for provided files

        /* Create collection */
        $mediaCollection = new Collection();
        $mediaCollection->setName((string) ($request->getData('name') ?? 'Empty'));
        $mediaCollection->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));
        $mediaCollection->setDescriptionRaw((string) ($request->getData('description') ?? ''));
        $mediaCollection->setCreatedBy($request->getHeader()->getAccount());
        $mediaCollection->setSources($files);

        CollectionMapper::create($mediaCollection);

        return $mediaCollection;
    }

    /**
     * Method to create template from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Template
     *
     * @since  1.0.0
     */
    private function createTemplateFromRequest(RequestAbstract $request, int $collectionId) : Template
    {
        $expected = $request->getData('expected');

        $helperTemplate = new Template();
        $helperTemplate->setName($request->getData('name') ?? 'Empty');
        $helperTemplate->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));
        $helperTemplate->setDescriptionRaw((string) ($request->getData('description') ?? ''));

        if ($collectionId > 0) {
            $helperTemplate->setSource($collectionId);
        }

        // todo: check if this is working. might not work correctly either because name is different or because type is invalid
        $helperTemplate->setStandalone((bool) ($request->getData('standalone') ?? false));
        $helperTemplate->setExpected(!empty($expected) ? \json_decode($expected, true) : []);
        $helperTemplate->setCreatedBy($request->getHeader()->getAccount());
        $helperTemplate->setDatatype((int) ($request->getData('datatype') ?? TemplateDataType::OTHER));

        return $helperTemplate;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiReportCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        // todo: check permission here
        $collection = $this->createMediaCollectionFromRequest($request);

        $report = $this->createReportFromRequest($request, $response, $collection->getId());
        $this->createModel($request, $report, ReportMapper::class, 'report');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Report', 'Report successfully created', $report);
    }

    /**
     * Method to create report from request.
     *
     * @param RequestAbstract  $request      Request
     * @param ResponseAbstract $response     Response
     * @param int              $collectionId Id of media collection
     *
     * @return Report
     *
     * @since  1.0.0
     */
    private function createReportFromRequest(RequestAbstract $request, ResponseAbstract $response, int $collectionId) : Report
    {
        $helperReport = new Report();
        $helperReport->setTitle((string) ($request->getData('name')));
        $helperReport->setSource($collectionId);
        $helperReport->setTemplate((int) $request->getData('template'));
        $helperReport->setCreatedBy($request->getHeader()->getAccount());

        return $helperReport;
    }
}
