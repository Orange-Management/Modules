<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Reporter;

use Model\Message\Redirect;
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
 * @copyright  Dennis Eichhorn
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
    /* public */ const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    /* public */ const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    /* public */ const MODULE_NAME = 'Reporter';

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
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewTemplateList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Reporter/Theme/Backend/reporter-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002701001, $request, $response));

        $reports = TemplateMapper::getNewest(25);
        $view->addData('reports', $reports);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewTemplateCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
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
     * @return \Serializable
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewReportCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
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
     * @return \Serializable
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewReportView(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
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
     * @return \Serializable
     *
     * @throws \Exception
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewReporterReport(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $template = TemplateMapper::get((int) $request->getData('id'));
        //$file = preg_replace('([^\w\s\d\-_~,;:\.\[\]\(\).])', '', $template->getName());

        $tcoll = [];
        $files = $template->getSource()->getSources();

        foreach ($files as $tMedia) {
            $lowerPath = strtolower($tMedia->getPath());

            if (StringUtils::endsWith($lowerPath, '.lang.php')) {
                $tcoll['lang'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, 'worker.php')) {
                $tcoll['worker'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.xlsx.php')) {
                $tcoll['excel'] = $tMedia;
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

                /** @var Head $head */
                $head = $response->get('Content')->getData('head');
                $head->addAsset(AssetType::CSS, $request->getUri()->getBase() . $tMedia->getPath());
            } elseif (StringUtils::endsWith($lowerPath, '.js')) {
                $tcoll['js'] = $tMedia;
            } elseif (StringUtils::endsWith($lowerPath, '.sqlite') || StringUtils::endsWith($lowerPath, '.db')) {
                $tcoll['db'][] = $tMedia;
            } else {
                // Do nothing; only the creator knows how to deal with this type of file :)
            }
        }

        if (!isset($tcoll['template'])) {
            throw new \Exception('No template file detected.');
        }

        $report = ReportMapper::getNewest(1, 
            (new Builder($this->app->dbPool->get()))->where('reporter_report.reporter_report_template', '=', $template->getId())
        ); /* todo newest that belongs to template x. right now always newest no matter the template */
        $rcoll  = [];

        $report = end($report);

        if (!($report instanceof NullReport)) {
            /** @var Media[] $files */
            $files = $report->getSource()->getSources();

            foreach ($files as $media) {
                $rcoll[$media->getName() . '.' . $media->getExtension()] = $media;
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
     * @return \Serializable
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
                        $response->getHeader()->set('Content-Type', MimeType::M_PDF, true);
                        break;
                    case 'csv':
                        $response->getHeader()->set('Content-Type', MimeType::M_CONF, true);
                        break;
                    case 'xlsx':
                        $response->getHeader()->set('Content-disposition', 'attachment; filename="' . $request->getData('id') . '.' . $request->getData('type') . '"', true);
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
                    $response->getHeader()->set('Content-disposition', 'attachment; filename="' . $request->getData('id') . '.' . $request->getData('type') . '"', true);
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
     * @return \Serializable
     *
     * @api
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiTemplateCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
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

        $collectionId = CollectionMapper::create($mediaCollection);

        /* Create template */
        $reporterTemplate = new Template();
        $reporterTemplate->setName($request->getData('name') ?? 'Empty');
        $reporterTemplate->setDescription($request->getData('description') ?? '');
        $reporterTemplate->setSource((int) $collectionId);
        $reporterTemplate->setExpected(!empty($expected) ? json_decode($expected, true) : []);
        $reporterTemplate->setCreatedBy($request->getAccount());
        $reporterTemplate->setCreatedAt(new \DateTime('NOW'));
        $reporterTemplate->setDatatype((int) ($request->getData('datatype') ?? TemplateDataType::OTHER));

        $template = TemplateMapper::create($reporterTemplate);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON . '; charset=utf-8', true);
        $response->set($request->__toString(), $template);
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @api
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiReportCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $files = json_decode($request->getData('files'));

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

        /* Create collection */
        $mediaCollection = new Collection();
        $mediaCollection->setName($request->getData('name'));
        $mediaCollection->setCreatedBy($request->getAccount());
        $mediaCollection->setCreatedAt(new \DateTime('NOW'));
        $mediaCollection->setSources($files);
        $collectionId = CollectionMapper::create($mediaCollection);

        /* Create template */
        $reporterReport = new Report();
        $reporterReport->setTitle($request->getData('name'));
        $reporterReport->setSource((int) $collectionId);
        $reporterReport->setTemplate((int) $request->getData('template'));
        $reporterReport->setCreatedBy($request->getAccount());
        $reporterReport->setCreatedAt(new \DateTime('NOW'));

        $reportId = ReportMapper::create($reporterReport);

        $response->set($request->__toString(), new Redirect($request->getUri()->getBase() . $request->getL11n()->getLanguage() . '/backend/reporter/list'));
    }

}
