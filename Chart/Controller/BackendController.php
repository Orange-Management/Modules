<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Chart
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Chart\Controller;

use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Html\Head;
use phpOMS\Views\View;

/**
 * Calendar controller class.
 *
 * @package Modules\Chart
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class BackendController extends Controller
{
    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function setUpChartEditor(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/cssOMS/chart/chart.css');
        $head->addAsset(AssetType::CSS, '/cssOMS/chart/chart_line.css');
        $head->addAsset(AssetType::CSS, '/cssOMS/chart/chart_area.css');
        $head->addAsset(AssetType::JS, '/jsOMS/Chart/Chart.js');
        $head->addAsset(AssetType::JSLATE, 'jsOMS/Chart/LineChart.js');
        $head->addAsset(AssetType::JSLATE, 'jsOMS/Chart/ColumnChart.js');
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChartCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Chart/Theme/Backend/chart-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004101001, $request, $response));

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChartCreateLine(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Chart/Theme/Backend/chart-create-line');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004101001, $request, $response));

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChartCreateArea(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Chart/Theme/Backend/chart-create-area');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004101001, $request, $response));

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChartList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Chart/Theme/Backend/chart-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004101001, $request, $response));

        return $view;
    }
}
