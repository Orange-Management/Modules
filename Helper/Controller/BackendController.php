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

use Modules\Media\Models\Media;
use Modules\Media\Theme\Backend\Components\Upload\BaseView;
use Modules\Helper\Models\NullReport;
use Modules\Helper\Models\PermissionState;
use Modules\Helper\Models\Report;
use Modules\Helper\Models\ReportMapper;
use Modules\Helper\Models\Template;
use Modules\Helper\Models\TemplateMapper;

use phpOMS\Account\PermissionType;
use phpOMS\Asset\AssetType;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Html\Head;
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
final class BackendController extends Controller
{

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewTemplateList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Helper/Theme/Backend/helper-list');
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
     * @codeCoverageIgnore
     */
    public function viewTemplateCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Helper/Theme/Backend/helper-template-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002701001, $request, $response));
        $view->addData('media-upload', new BaseView($this->app, $request, $response));

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

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
     * @codeCoverageIgnore
     */
    public function viewReportCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Helper/Theme/Backend/helper-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002701001, $request, $response));
        $view->addData('media-upload', new BaseView($this->app, $request, $response));

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

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
     * @codeCoverageIgnore
     */
    public function viewHelperReport(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        //$file = preg_replace('([^\w\s\d\-_~,;:\.\[\]\(\).])', '', $template->getName());

        $template = TemplateMapper::get((int) $request->getData('id'));

        $view->setTemplate('/Modules/Helper/Theme/Backend/helper-single');

        $tcoll = [];
        $files = $template->getSource()->getSources();

        foreach ($files as $tMedia) {
            $lowerPath = strtolower($tMedia->getPath());

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

        if (!$template->isStandalone()) {
            if (!isset($tcoll['template'])) {
                throw new \Exception('No template file detected.');
            }

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
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002701001, $request, $response));

        return $view;
    }
}
