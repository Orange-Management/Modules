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
namespace Modules\Accounting;

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
 * Accounting class.
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
     * @var \string
     * @since 1.0.0
     */
    const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var \string
     * @since 1.0.0
     */
    const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $module = 'Accounting';

    /**
     * Localization files.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $localization = [
        RequestDestination::BACKEND => ['backend'],
    ];

    /**
     * Routing elements.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $routes = [
        '^.*/backend/accounting/personal/entries.*$'   => [['dest' => '\Modules\Accounting\Controller:viewPersonalEntries', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/impersonal/entries.*$' => [['dest' => '\Modules\Accounting\Controller:viewImpersonalEntries', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/entries.*$'            => [['dest' => '\Modules\Accounting\Controller:viewEntries', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/backend/accounting/impersonal/journal/list.*$' => [['dest' => '\Modules\Accounting\Controller:viewJournalList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/backend/accounting/stack/list.*$'         => [['dest' => '\Modules\Accounting\Controller:viewStackList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/stack/entries.*$'      => [['dest' => '\Modules\Accounting\Controller:viewStackEntries', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/stack/archive/list.*$' => [['dest' => '\Modules\Accounting\Controller:viewStackArchiveList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/stack/create.*$' => [['dest' => '\Modules\Accounting\Controller:viewStackCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/backend/accounting/gl/list.*$'    => [['dest' => '\Modules\Accounting\Controller:viewGLList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/gl/create.*$'  => [['dest' => '\Modules\Accounting\Controller:viewGLCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/gl/profile.*$' => [['dest' => '\Modules\Accounting\Controller:viewGLProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/api/accounting/dun/print.*$'         => [['dest' => '\Modules\Accounting\Controller:viewCostCenterProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/api/accounting/statement/print.*$'   => [['dest' => '\Modules\Accounting\Controller:viewCostCenterProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/api/accounting/balances/print.*$'    => [['dest' => '\Modules\Accounting\Controller:viewCostCenterProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/api/accounting/accountform/print.*$' => [['dest' => '\Modules\Accounting\Controller:viewCostCenterProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
    ];

    /**
     * Providing.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $providing = [
        'Content',
    ];

    /**
     * Dependencies.
     *
     * @var \string
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
    public function viewEntries(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/backend/entries');
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
    public function viewJournalList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/backend/journal-list');
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
    public function viewStackList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/backend/stack-list');
        $view->addData('nav', $this->createNavigation(1002605001, $request, $response));

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
    public function viewStackCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/backend/stack-create');
        $view->addData('nav', $this->createNavigation(1002605001, $request, $response));

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
    public function viewStackEntries(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/backend/stack-entries');
        $view->addData('nav', $this->createNavigation(1002605001, $request, $response));

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
    public function viewStackArchiveList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/backend/stack-archive-list');
        $view->addData('nav', $this->createNavigation(1002605001, $request, $response));

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
    public function viewGLList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/backend/gl-list');
        $view->addData('nav', $this->createNavigation(1002602001, $request, $response));

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
    public function viewGLCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/backend/gl-create');
        $view->addData('nav', $this->createNavigation(1002602001, $request, $response));

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
    public function viewGLProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Accounting/Theme/backend/gl-profile');
        $view->addData('nav', $this->createNavigation(1002602001, $request, $response));

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
    private function createNavigation(\int $pageId, RequestAbstract $request, ResponseAbstract $response)
    {
        $nav     = Navigation::getInstance($request, $this->app->dbPool);
        $navView = new NavigationView($this->app, $request, $response);
        $navView->setTemplate('/Modules/Navigation/Theme/backend/mid');
        $navView->setNav($nav->getNav());
        $navView->setLanguage($request->getL11n()->language);
        $navView->setParent($pageId);

        return $navView;
    }
}
