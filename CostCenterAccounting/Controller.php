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
namespace Modules\CostCenterAccounting;

use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Views\ViewLayout;

/**
 * CostCenterAccounting class.
 *
 * @category   Modules
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
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
    /* public */ const MODULE_NAME = 'CostCenterAccounting';

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
        'Media',
    ];

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
    public function viewCostCenterList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/CostCenterAccounting/Theme/Backend/costcenter-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004501001, $request, $response));

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
    public function viewCostCenterCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/CostCenterAccounting/Theme/Backend/costcenter-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004501001, $request, $response));

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
    public function viewCostCenterProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/CostCenterAccounting/Theme/Backend/costcenter-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004501001, $request, $response));

        return $view;
    }

}
