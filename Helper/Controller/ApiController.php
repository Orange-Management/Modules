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
use Modules\Media\Models\MediaMapper;
use Modules\Helper\Models\PermissionState;
use Modules\Helper\Models\Report;
use Modules\Helper\Models\ReportMapper;
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
                    . $template->getName() . '.'
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
                $view->setTemplate('/' . \substr($view->getData('tcoll')['template']->getPath(), 0, -8));
        }

        if ($request->getData('download') !== null) {
            $response->getHeader()->set('Content-Type', MimeType::M_BIN, true);
            $response->getHeader()->set('Content-Transfer-Encoding', 'Binary', true);
            $response->getHeader()->set(
                'Content-disposition', 'attachment; filename="'
                . $template->getName() . '.'
                . ((string) $request->getData('type'))
                . '"'
            , true);
        }

        $response->set('export', $view);
    }

    private function createView(Template $template, RequestAbstract $request, ResponseAbstract $response) : View
    {
        $tcoll = [];
        $files = $template->getSource()->getSources();

        foreach ($files as $tMedia) {
            $lowerPath = \strtolower($tMedia->getPath());

            if (StringUtils::endsWith($lowerPath, '.lang.php')) {
                $tcoll['lang'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, 'worker.php')) {
                $tcoll['worker'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.xlsx.php') || StringUtils::endsWith($lowerPath, '.xls.php')) {
                $tcoll['excel'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.docx.php') || StringUtils::endsWith($lowerPath, '.doc.php')) {
                $tcoll['word'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.pptx.php') || StringUtils::endsWith($lowerPath, '.ppt.php')) {
                $tcoll['powerpoint'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.pdf.php')) {
                $tcoll['pdf'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.csv.php')) {
                $tcoll['csv'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.json.php')) {
                $tcoll['json'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.tpl.php')) {
                $tcoll['template'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.css')) {
                $tcoll['css'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.js')) {
                $tcoll['js'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.sqlite') || StringUtils::endsWith($lowerPath, '.db')) {
                $tcoll['db'][] = $tMedia;
            } else {
                // Do nothing; only the creator knows how to deal with this type of file :)
            }
        }

        $view = new View($this->app, $request, $response);
        if (!$template->isStandalone()) {
            $report = ReportMapper::getNewest(1,
                (new Builder($this->app->dbPool->get()))->where('helper_report.helper_report_template', '=', $template->getId())
            );

            $rcoll  = [];
            $report = end($report);
            $report = $report === false ? new NullReport() : $report;

            if (!($report instanceof NullReport)) {
                /** @var Media[] $files */
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
        $collectionId = $this->createMediaCollectionFromRequest($request);
        $template     = $this->createTemplateFromRequest($request, $collectionId);

        $this->createModel($request, $template, TemplateMapper::class, 'template');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Template', 'Template successfully created', $template);
    }

    private function createMediaCollectionFromRequest(RequestAbstract $request) : int
    {
        if ($request->getData('media-list') === null) {
            return -1;
        }

        $files = \json_decode((string) $request->getData('media-list'), true);
        // TODO: make sure this user has permissions for provided files

        /* Create collection */
        $mediaCollection = new Collection();
        $mediaCollection->setName((string) ($request->getData('name') ?? 'Empty'));
        $mediaCollection->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));
        $mediaCollection->setDescriptionRaw((string) ($request->getData('description') ?? ''));
        $mediaCollection->setCreatedBy($request->getHeader()->getAccount());
        $mediaCollection->setSources($files);

        return (int) CollectionMapper::create($mediaCollection);
    }

    private function createTemplateFromRequest(RequestAbstract $request, int $collectionId) : Template
    {
        $expected = $request->getData('expected');

        $helperTemplate = new Template();
        $helperTemplate->setName($request->getData('name') ?? 'Empty');
        $helperTemplate->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));
        $helperTemplate->setDescriptionRaw((string) ($request->getData('description') ?? ''));

        if ($collectionId > 0) {
            $helperTemplate->setSource((int) $collectionId);
        }

        $helperTemplate->setStandalone((bool) $request->getData('standalone') ?? false);
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

        $this->handleTemplateDatabaseFromRequest($request);
        $collectionId = $this->createMediaCollectionFromRequest($request);

        $report = $this->createReportFromRequest($request, $response, $collectionId);
        $this->createModel($request, $report, ReportMapper::class, 'report');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Report', 'Report successfully created', $report);
    }

    private function createReportFromRequest(RequestAbstract $request, ResponseAbstract $response, int $collectionId) : Report
    {
        $helperReport = new Report();
        $helperReport->setTitle((string) ($request->getData('name')));
        $helperReport->setSource((int) $collectionId);
        $helperReport->setTemplate((int) $request->getData('template'));
        $helperReport->setCreatedBy($request->getHeader()->getAccount());

        return $helperReport;
    }

    private function handleTemplateDatabaseFromRequest(RequestAbstract $request) : void
    {
        $files = \json_decode((string) ($request->getData('files')));

        // TODO: make sure user has permission for files
        // TODO: make sure user has permission for template

        /* Init Template */
        $template = TemplateMapper::get((int) $request->getData('template'));

        if ($template->getDatatype() === TemplateDataType::GLOBAL_DB) {
            $templateFiles = MediaMapper::get($template->getSource());

            foreach ($templateFiles as $templateFile) {
                $dbFile = MediaMapper::get($templateFile);

                // Found centralized db
                if ($dbFile->getExtension() === '.sqlite') {
                    $this->app->dbPool->create('helper_1', ['db' => 'sqlite', 'path' => $dbFile->getPath()]);
                    $csvDbMapper   = new CsvDatabaseMapper($this->app->dbPool->get('helper_1'));
                    $excelDbMapper = new ExcelDatabaseMapper($this->app->dbPool->get('helper_1'));
                    $csvDbMapper->autoIdentifyCsvSettings(true);

                    foreach ($files as $file) {
                        $mediaFile = MediaMapper::get($file);

                        if (StringUtils::endsWith($mediaFile->getFilename(), '.db') && $mediaFile->getExtension() === '.csv') {
                            $csvDbMapper->addSource($mediaFile->getPath());
                        } elseif (StringUtils::endsWith($mediaFile->getFilename(), '.db') && ($mediaFile->getExtension() === '.xls' || $mediaFile->getExtension() === '.xlsx')) {
                            $excelDbMapper->addSource($mediaFile->getPath());
                        }
                    }

                    $csvDbMapper->insert();
                    $excelDbMapper->insert();

                    break;
                }
            }
        }
    }
}
