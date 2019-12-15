<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Exchange
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Controller;

use Modules\Exchange\Models\InterfaceManagerMapper;

use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Exchange controller class.
 *
 * @package Modules\Exchange
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
    public function viewExchangeDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        return $view;
    }

    /**
     * Method which generates the export list view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewExchangeExportList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-export-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        $interfaces = InterfaceManagerMapper::getAll();

        $export = [];
        foreach ($interfaces as $interface) {
            if ($interface->hasExport()) {
                $export[] = $interface;
            }
        }

        $view->addData('interfaces', $export);

        return $view;
    }

    /**
     * Method which generates the import list view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewExchangeImportList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-import-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        $interfaces = InterfaceManagerMapper::getAll();

        $import = [];
        foreach ($interfaces as $interface) {
            if ($interface->hasImport()) {
                $import[] = $interface;
            }
        }

        $view->addData('interfaces', $import);

        return $view;
    }

    /**
     * Method which generates the export view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewExchangeExport(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-export');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        return $view;
    }

    /**
     * Method which generates the import view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewExchangeImport(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-import');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        $interface = InterfaceManagerMapper::get((int) $request->getData('id'));

        $view->addData('interface', $interface);

        $lang = include __DIR__ . '/../Interfaces/' . $interface->getInterfacePath() . '/' . $response->getHeader()->getL11n()->getLanguage() . '.lang.php';
        $view->addData('lang', $lang);

        return $view;
    }
}
