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
namespace Modules\Admin;

use Modules\Admin\Models\AccountMapper;
use Modules\Admin\Models\GroupMapper;
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
 * Admin controller class.
 *
 * @category   Modules
 * @package    Modules\Admin
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
    const MODULE_NAME = 'Admin';

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
    protected static $dependencies = [];

    /**
     * Routing elements.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $routes = [
        '^.*/backend/admin/settings/general.*$' => [['dest' => '\Modules\Admin\Controller:viewSettingsGeneral', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/backend/admin/account/list.*$'     => [['dest' => '\Modules\Admin\Controller:viewAccountList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/admin/account/settings.*$' => [['dest' => '\Modules\Admin\Controller:viewAccountSettings', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/admin/account/create.*$'   => [['dest' => '\Modules\Admin\Controller:viewAccountCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/backend/admin/group/list.*$'     => [['dest' => '\Modules\Admin\Controller:viewGroupList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/admin/group/settings.*$' => [['dest' => '\Modules\Admin\Controller:viewGroupSettings', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/admin/group/create.*$'   => [['dest' => '\Modules\Admin\Controller:viewGroupCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/backend/admin/module/list.*$'     => [['dest' => '\Modules\Admin\Controller:viewModuleList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/admin/module/settings.*$' => [['dest' => '\Modules\Admin\Controller:viewModuleProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
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
    public function viewSettingsGeneral(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $settings = $this->app->appSettings->get([
            1000000009,
            1000000019,
            1000000020,
            1000000021,
            1000000022,
            1000000023,
            1000000027,
            1000000028,
        ]);

        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/settings-general');
        $view->addData('nav', $this->createNavigation(1000104001, $request, $response));

        $view->setData('oname', $settings[1000000009]);
        $view->setData('country', $settings[1000000019]);
        $view->setData('timezone', $settings[1000000021]);
        $view->setData('timeformat', $settings[1000000022]);
        $view->setData('language', $settings[1000000020]);
        $view->setData('currency', $settings[1000000023]);
        $view->setData('decimal_point', $settings[1000000027]);
        $view->setData('thousands_sep', $settings[1000000028]);
        $view->setData('countries', $settings[1000000028]);

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
    public function viewAccountList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-list');
        $view->addData('nav', $this->createNavigation(1000104001, $request, $response));

        $accountMapper = new AccountMapper($this->app->dbPool->get());
        $view->setData('list:elements', $accountMapper->getAll());
        $view->setData('list:count', 1);

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
    public function viewAccountSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-single');
        $view->addData('nav', $this->createNavigation(1000104001, $request, $response));

        $accountMapper = new AccountMapper($this->app->dbPool->get());
        $view->addData('account', $accountMapper->get((int) $request->getData('id')));

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
    public function viewAccountCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-create');
        $view->addData('nav', $this->createNavigation(1000104001, $request, $response));

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
    public function viewGroupList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-list');
        $view->addData('nav', $this->createNavigation(1000103001, $request, $response));

        $groupMapper = new GroupMapper($this->app->dbPool->get());
        $view->setData('list:elements', $groupMapper->getAll());

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
    public function viewGroupSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-single');
        $view->addData('nav', $this->createNavigation(1000103001, $request, $response));

        $groupMapper = new GroupMapper($this->app->dbPool->get());
        $view->addData('group', $groupMapper->get((int) $request->getData('id')));

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
    public function viewGroupCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-create');
        $view->addData('nav', $this->createNavigation(1000103001, $request, $response));

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
    public function viewModuleList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/modules-list');

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
    public function viewModuleProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/modules-single');

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
