<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Reporter
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Reporter\Controller;

use phpOMS\Model\Message\Redirect;
use Modules\Media\Models\Collection;
use Modules\Media\Models\CollectionMapper;
use Modules\Media\Models\Media;
use Modules\Media\Models\MediaMapper;
use Modules\Reporter\Models\NullReport;
use Modules\Reporter\Models\Report;
use Modules\Reporter\Models\ReportMapper;
use Modules\Reporter\Models\Template;
use Modules\Reporter\Models\TemplateDataType;
use Modules\Reporter\Models\TemplateMapper;
use Modules\Reporter\Models\PermissionState;

use phpOMS\Asset\AssetType;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Html\Head;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\System\MimeType;
use phpOMS\Utils\IO\Csv\CsvDatabaseMapper;
use phpOMS\Utils\IO\Excel\ExcelDatabaseMapper;
use phpOMS\Utils\StringUtils;
use phpOMS\Views\View;
use phpOMS\Account\PermissionType;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Utils\Parser\Markdown\Markdown;
use phpOMS\Message\NotificationLevel;

/**
 * TODO: Implement auto sqlite generator on upload
 */

/**
 * Reporter controller class.
 *
 * @package    Modules\Reporter
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.
 * @link       http://orange-managementcom
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class ApiController extends Controller
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
    public function apiReporterSingle(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $template  = TemplateMapper::get((int) $request->getData('id'));
        $accountId = $request->getHeader()->getAccount();

        if ($template->getCreatedBy()->getId() !== $accountId // todo: also check if report createdBy
            && !$this->app->accountManager->get($accountId)->hasPermission(
            PermissionType::READ, $this->app->orgId, null, self::MODULE_NAME, PermissionState::REPORT, $template->getId())
        ) {
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
        }

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
                    . ((string) $request->getData('id')) . '.'
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
                // TODO handle bad request
        }

        if ($request->getData('download') !== null) {
            $response->getHeader()->set('Content-Type', MimeType::M_BIN, true);
            $response->getHeader()->set('Content-Transfer-Encoding', 'Binary', true);
            $response->getHeader()->set(
                'Content-disposition', 'attachment; filename="'
                . ((string) $request->getData('id')) . '.'
                . ((string) $request->getData('type'))
                . '"'
            , true);
        }

        /** @var array $reportLanguage */
        /** @noinspection PhpIncludeInspection */
        include_once __DIR__ . '/Templates/' . $request->getData('id') . '/' . $request->getData('id') . '.lang.php';

        $exportView = new View($this->app, $request, $response);
        $exportView->addData('lang', $reportLanguage[$this->app->accountManager->get($request->getHeader()->getAccount())->getL11n()->getLanguage()]);
        $exportView->setTemplate(
            '/Modules/Reporter/Templates/'
            . ((string) $request->getData('id')) . '/'
            . ((string) $request->getData('id')) . '.'
            . ((string) $request->getData('type'))
        );
        $response->set('export', $exportView->render());
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

        $response->getHeader()->set('Content-Type', MimeType::M_JSON . '; charset=utf-8', true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
            'title' => 'Template',
            'message' => 'Template successfully created.',
            'response' => $template->jsonSerialize()
        ]);
    }

    private function createMediaCollectionFromRequest(RequestAbstract $request) : int
    {
        if ($request->getData('files') === null) {
            return -1;
        }

        $files = \json_decode((string) $request->getData('files'));
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

        $reporterTemplate = new Template();
        $reporterTemplate->setName($request->getData('name') ?? 'Empty');
        $reporterTemplate->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));
        $reporterTemplate->setDescriptionRaw((string) ($request->getData('description') ?? ''));

        if ($collectionId > 0) {
            $reporterTemplate->setSource((int) $collectionId);
        }

        $reporterTemplate->setStandalone((bool) $request->getData('standalone') ?? false);
        $reporterTemplate->setExpected(!empty($expected) ? \json_decode($expected, true) : []);
        $reporterTemplate->setCreatedBy($request->getHeader()->getAccount());
        $reporterTemplate->setDatatype((int) ($request->getData('datatype') ?? TemplateDataType::OTHER));

        TemplateMapper::create($reporterTemplate);

        return $reporterTemplate;
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
        $this->handleTemplateDatabaseFromRequest($request);
        $collectionId = $this->createMediaCollectionFromRequest($request);
        $report       = $this->createReportFromRequest($request, $response, $collectionId);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON . '; charset=utf-8', true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
            'title' => 'Report',
            'message' => 'Report successfully created.',
            'response' => $report->jsonSerialize()
        ]);
    }

    private function createReportFromRequest(RequestAbstract $request, ResponseAbstract $response, int $collectionId) : Report
    {
        $reporterReport = new Report();
        $reporterReport->setTitle((string) ($request->getData('name')));
        $reporterReport->setSource((int) $collectionId);
        $reporterReport->setTemplate((int) $request->getData('template'));
        $reporterReport->setCreatedBy($request->getHeader()->getAccount());

        ReportMapper::create($reporterReport);

        return $reporterReport;
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
                    $this->app->dbPool->create('reporter_1', ['db' => 'sqlite', 'path' => $dbFile->getPath()]);
                    $csvDbMapper   = new CsvDatabaseMapper($this->app->dbPool->get('reporter_1'));
                    $excelDbMapper = new ExcelDatabaseMapper($this->app->dbPool->get('reporter_1'));
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
