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
namespace Modules\Business;

use Modules\Business\Models\DepartmentMapper;
use Modules\Business\Models\UnitMapper;
use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\RequestDestination;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Views\ViewLayout;

/**
 * Business Controller class.
 *
 * @category   Modules
 * @package    Modules\Business
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
    const MODULE_NAME = 'Business';

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
        '^.*/backend/business/unit/list.*$'    => [['dest' => '\Modules\Business\Controller:viewUnitList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/business/unit/profile.*$' => [['dest' => '\Modules\Business\Controller:viewUnitProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/business/unit/create.*$'  => [['dest' => '\Modules\Business\Controller:viewUnitCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/backend/business/department/list.*$'    => [['dest' => '\Modules\Business\Controller:viewDepartmentList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/business/department/profile.*$' => [['dest' => '\Modules\Business\Controller:viewDepartmentProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/business/department/create.*$'  => [['dest' => '\Modules\Business\Controller:viewDepartmentCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/backend/business/position/list.*$'    => [['dest' => '\Modules\Business\Controller:viewPositionList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/business/position/profile.*$' => [['dest' => '\Modules\Business\Controller:viewPositionProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/business/position/create.*$'  => [['dest' => '\Modules\Business\Controller:viewPositionCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
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
    public function viewUnitList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Business/Theme/Backend/unit-list');
        $view->addData('nav', $this->createNavigation(1004702001, $request, $response));

        $unitMapper = new UnitMapper($this->app->dbPool->get());
        $view->addData('list:elements', $unitMapper->getAll());

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
    public function viewUnitProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Business/Theme/Backend/unit-profile');
        $view->addData('nav', $this->createNavigation(1004702001, $request, $response));

        $unitMapper = new UnitMapper($this->app->dbPool->get());
        $view->addData('unit', $unitMapper->get((int) $request->getData('id')));

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
    public function viewUnitCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Business/Theme/Backend/unit-create');
        $view->addData('nav', $this->createNavigation(1004702001, $request, $response));

        $unitMapper = new UnitMapper($this->app->dbPool->get());
        $view->addData('unit', $unitMapper->get((int) $request->getData('id')));

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
    public function viewDepartmentList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Business/Theme/Backend/department-list');
        $view->addData('nav', $this->createNavigation(1004703001, $request, $response));

        $departmentMapper = new DepartmentMapper($this->app->dbPool->get());
        $view->addData('list:elements', $departmentMapper->getAll());

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
    public function viewDepartmentProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Business/Theme/Backend/department-profile');
        $view->addData('nav', $this->createNavigation(1004703001, $request, $response));

        $departmentMapper = new DepartmentMapper($this->app->dbPool->get());
        $view->addData('unit', $departmentMapper->get((int) $request->getData('id')));

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
    public function viewDepartmentCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Business/Theme/Backend/department-create');
        $view->addData('nav', $this->createNavigation(1004703001, $request, $response));

        $unitMapper = new UnitMapper($this->app->dbPool->get());
        $view->addData('unit', $unitMapper->get((int) $request->getData('id')));

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
    public function viewPositionList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Business/Theme/Backend/position-list');
        $view->addData('nav', $this->createNavigation(1004704001, $request, $response));

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
    public function viewPositionProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Business/Theme/Backend/position-profile');
        $view->addData('nav', $this->createNavigation(1004704001, $request, $response));

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
    public function viewPositionCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Business/Theme/Backend/position-create');
        $view->addData('nav', $this->createNavigation(1004704001, $request, $response));

        return $view;
    }

    /**
     * @param int              $pageId   Page/parent Id for navigation
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function createNavigation(int $pageId, RequestAbstract $request, ResponseAbstract $response)
    {
        $nav     = Navigation::getInstance($request, $this->app->dbPool);
        $navView = new NavigationView($this->app, $request, $response);
        $navView->setTemplate('/Modules/Navigation/Theme/Backend/mid');
        $navView->setNav($nav->getNav());
        $navView->setLanguage($request->getL11n()->getLanguage());
        $navView->setParent($pageId);

        return $navView;
    }
}
