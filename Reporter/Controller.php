<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Reporter;

use Modules\Media\Models\Collection;
use Modules\Media\Models\CollectionMapper;
use Modules\Media\Models\MediaMapper;
use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;
use Modules\Reporter\Models\NullReport;
use Modules\Reporter\Models\Report;
use Modules\Reporter\Models\ReportMapper;
use Modules\Reporter\Models\Template;
use Modules\Reporter\Models\TemplateDataType;
use Modules\Reporter\Models\TemplateMapper;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\RequestDestination;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\System\MimeType;
use phpOMS\Utils\IO\Csv\CsvDatabaseMapper;
use phpOMS\Utils\IO\Excel\ExcelDatabaseMapper;
use phpOMS\Utils\StringUtils;
use phpOMS\Views\View;
use phpOMS\Views\ViewLayout;

/**
 * TODO: Implement auto sqlite generator on upload
 */

/**
 * Reporter controller class.
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.
 * @link       http://orange-management.com * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_NAME = 'Reporter';

    /**
     * Localization files.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $localization = [
        RequestDestination::BACKEND => [''],
    ];

    /**
     * Providing.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];

    /**
     * Routing elements.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $routes = [
        '^.*/backend/reporter/template/create.*$' => [
            ['dest' => '\Modules\Reporter\Controller:setUpFileUploader', 'method' => 'GET', 'type' => ViewLayout::NULL],
            ['dest' => '\Modules\Reporter\Controller:viewTemplateCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],
        ],
        '^.*/backend/reporter/report/create.*$'   => [
            ['dest' => '\Modules\Reporter\Controller:setUpFileUploader', 'method' => 'GET', 'type' => ViewLayout::NULL],
            ['dest' => '\Modules\Reporter\Controller:viewReportCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],
        ],

        '^.*/backend/reporter/list.*$'        => [['dest' => '\Modules\Reporter\Controller:viewTemplateList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/reporter/report/view.*$' => [['dest' => '\Modules\Reporter\Controller:viewReporterReport', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/api/reporter/report/export.*$' => [['dest' => '\Modules\Reporter\Controller:viewReporterExport', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/api/reporter/template.*$'      => [['dest' => '\Modules\Reporter\Controller:apiCreateTemplate', 'method' => 'POST', 'type' => ViewLayout::NULL],],
        '^.*/api/reporter/report.*$'        => [['dest' => '\Modules\Reporter\Controller:apiCreateReport', 'method' => 'POST', 'type' => ViewLayout::NULL],],
    ];

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setUpFileUploader(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $head = $response->getHead();
        $head->addAsset(AssetType::JS, $request->getUri()->getBase() . 'Modules/Media/ModuleMedia.js');
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewTemplateList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Reporter/Theme/Backend/reporter-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002701001, $request, $response));


        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewTemplateCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Reporter/Theme/Backend/reporter-template-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002701001, $request, $response));

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewReportCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Reporter/Theme/Backend/reporter-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002701001, $request, $response));

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewReportView(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Reporter/Theme/reporter/reporter-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002701001, $request, $response));

        $dataView = new View($this->app, $request, $response);
        $dataView->setTemplate('/Modules/Reporter/Templates/' . $request->getData('id') . '/' . $request->getData('id'));
        $view->addData('name', $request->getData('id'));
        $view->addView('DataView', $dataView);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @throws
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewReporterReport(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $templateMapper = new TemplateMapper($this->app->dbPool->get());
        $template       = $templateMapper->get((int) $request->getData('id'));

        //$file = preg_replace('([^\w\s\d\-_~,;:\.\[\]\(\).])', '', $template->getName());

        $collectionMapper = new CollectionMapper($this->app->dbPool->get());
        $collection       = $collectionMapper->get($template->getSource());

        $tcoll = [];
        $files = $collection->getSources();

        foreach ($files as $tMedia) {
            $path = $tMedia->getPath();

            if (StringUtils::endsWith(strtolower($path), '.lang.php')) {
                $tcoll['lang'] = $tMedia;
            } elseif (StringUtils::endsWith(strtolower($path), 'worker.php')) {
                $tcoll['worker'] = $tMedia;
            } elseif (StringUtils::endsWith(strtolower($path), '.xlsx.php')) {
                $tcoll['excel'] = $tMedia;
            } elseif (StringUtils::endsWith(strtolower($path), '.pdf.php')) {
                $tcoll['pdf'] = $tMedia;
            } elseif (StringUtils::endsWith(strtolower($path), '.csv.php')) {
                $tcoll['csv'] = $tMedia;
            } elseif (StringUtils::endsWith(strtolower($path), '.json.php')) {
                $tcoll['json'] = $tMedia;
            } elseif (StringUtils::endsWith(strtolower($path), '.tpl.php')) {
                $tcoll['template'] = $tMedia;
            } elseif (StringUtils::endsWith(strtolower($path), '.css')) {
                $tcoll['css'] = $tMedia;
            } elseif (StringUtils::endsWith(strtolower($path), '.js')) {
                $tcoll['js'] = $tMedia;
            } elseif (StringUtils::endsWith(strtolower($path), '.sqlite') || StringUtils::endsWith(strtolower($path), '.db')) {
                $tcoll['db'][] = $tMedia;
            } else {
                // Do nothing; only the creator knows how to deal with this type of file :)
            }
        }

        if (!isset($tcoll['template'])) {
            throw new \Exception('No template file detected.');
        }

        $reportMapper = new ReportMapper($this->app->dbPool->get());
        $report       = $reportMapper->getNewest(1, (new Builder($this->app->dbPool->get()))->where('reporter_report.reporter_report_template', '=', $template->getId())); /* todo newest that belongs to template x. right now always newest no matter the template */
        $rcoll        = [];

        if (!($report instanceof NullReport)) {
            $collection = $collectionMapper->get($report->getSource());
            $files      = $collection->getSources();

            foreach ($files as $media) {
                $rcoll[$media->getName()] = $media;
            }
        }

        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Reporter/Theme/Backend/reporter-single');
        $view->addData('tcoll', $tcoll);
        $view->addData('lang', $request->getL11n()->getLanguage());
        $view->addData('template', $template);
        $view->addData('report', $report);
        $view->addData('rcoll', $rcoll);
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002701001, $request, $response));

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @api
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiReporterSingle(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        switch ($request->getPath(3)) {
            case 'export':
                switch ($request->getData('type')) {
                    case 'pdf':
                        $response->setHeader('Content-Type', MimeType::M_PDF, true);
                        break;
                    case 'csv':
                        $response->setHeader('Content-Type', MimeType::M_CONF, true);
                        break;
                    case 'xlsx':
                        $response->setHeader('Content-disposition', 'attachment; filename="' . $request->getData('id') . '.' . $request->getData('type') . '"', true);
                        $response->setHeader('Content-Type', MimeType::M_XLSX, true);

                        $response->setHeader('Content-Type', MimeType::M_XLSX, true);
                        break;
                    case 'json':
                        $response->setHeader('Content-Type', MimeType::M_JSON, true);
                        break;
                    default:
                        // TODO handle bad request
                }

                if ($request->getData('download') !== null) {
                    $response->setHeader('Content-Type', MimeType::M_BIN, true);
                    $response->setHeader('Content-Transfer-Encoding', 'Binary', true);
                    $response->setHeader('Content-disposition', 'attachment; filename="' . $request->getData('id') . '.' . $request->getData('type') . '"', true);
                }

                /** @var array $reportLanguage */
                /** @noinspection PhpIncludeInspection */
                include_once __DIR__ . '/Templates/' . $request->getData('id') . '/' . $request->getData('id') . '.lang.php';

                $exportView = new View($this->app, $request, $response);
                $exportView->addData('lang', $reportLanguage[$this->app->accountManager->get($request->getAccount())->getL11n()->getLanguage()]);
                $exportView->setTemplate('/Modules/Reporter/Templates/' . $request->getData('id') . '/' . $request->getData('id') . '.' . $request->getData('type'));
                $response->set('export', $exportView->render());
                break;
        }
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @api
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiCreateTemplate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $files    = json_decode($request->getData('files'));
        $expected = $request->getData('expected');

        // TODO: make sure this user has permissions for provided files

        /* Create collection */
        $mediaCollection = new Collection();
        $mediaCollection->setName($request->getData('name') ?? 'Empty');
        $mediaCollection->setDescription($request->getData('description') ?? '');
        $mediaCollection->setCreatedBy($request->getAccount());
        $mediaCollection->setCreatedAt(new \DateTime('NOW'));
        $mediaCollection->setSources($files);

        $mediaCollectionMapper = new CollectionMapper($this->app->dbPool->get());
        $collectionId          = $mediaCollectionMapper->create($mediaCollection);

        /* Create template */
        $reporterTemplate = new Template();
        $reporterTemplate->setName($request->getData('name') ?? 'Empty');
        $reporterTemplate->setDescription($request->getData('description') ?? '');
        $reporterTemplate->setSource($collectionId);
        $reporterTemplate->setExpected(isset($expected) ? json_decode($expected, true) : []);
        $reporterTemplate->setCreatedBy($request->getAccount());
        $reporterTemplate->setCreatedAt(new \DateTime('NOW'));
        $reporterTemplate->setDatatype((int) ($request->getData('datatype') ?? TemplateDataType::OTHER));

        $reporterTemplateMapper = new TemplateMapper($this->app->dbPool->get());
        $templateId             = $reporterTemplateMapper->create($reporterTemplate);

        $response->set($request->__toString(), $templateId);
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @api
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiCreateReport(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $files = json_decode($request->getData('files'));

        // TODO: make sure user has permission for files
        // TODO: make sure user has permission for template

        $collectionMapper = new CollectionMapper($this->app->dbPool->get());
        $mediaMapper      = new MediaMapper($this->app->dbPool->get());

        /* Init Template */
        $templateMapper = new TemplateMapper($this->app->dbPool->get());
        $template       = $templateMapper->get((int) $request->getData('template'));

        if ($template->getDatatype() === TemplateDataType::GLOBAL_DB) {
            $templateFiles = $mediaMapper->get($template->getSource());

            foreach ($templateFiles as $templateFile) {
                $dbFile = $mediaMapper->get($templateFile);

                // Found centralized db
                if ($dbFile->getExtension() === '.sqlite') {
                    $this->app->dbPool->create('reporter_1', ['db' => 'sqlite', 'path' => $dbFile->getPath()]);
                    $csvDbMapper   = new CsvDatabaseMapper($this->app->dbPool->get('reporter_1'));
                    $excelDbMapper = new ExcelDatabaseMapper($this->app->dbPool->get('reporter_1'));
                    $csvDbMapper->autoIdentifyCsvSettings(true);

                    foreach ($files as $file) {
                        $mediaFile = $mediaMapper->get($file);

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

        /* Create collection */
        $mediaCollection = new Collection();
        $mediaCollection->setName($request->getData('name'));
        $mediaCollection->setCreatedBy($request->getAccount());
        $mediaCollection->setCreatedAt(new \DateTime('NOW'));
        $mediaCollection->setSources($files);
        $collectionId = $collectionMapper->create($mediaCollection);

        /* Create template */
        $reporterReport = new Report();
        $reporterReport->setTitle($request->getData('name'));
        $reporterReport->setSource($collectionId);
        $reporterReport->setTemplate((int) $request->getData('template'));
        $reporterReport->setCreatedBy($request->getAccount());
        $reporterReport->setCreatedAt(new \DateTime('NOW'));

        $reporterReportMapper = new ReportMapper($this->app->dbPool->get());
        $reportId             = $reporterReportMapper->create($reporterReport);

        $response->set($request->__toString(), $reportId);
    }

}
