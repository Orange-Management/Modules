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
namespace Modules\AccountsReceivable;

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
 * Sales class.
 *
 * @category   Modules
 * @package    Modules\Accountsreceivable
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
    const MODULE_NAME = 'AccountsReceivable';

    /**
     * Localization files.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $localization = [
        RequestDestination::BACKEND => [''],
    ];

    /**
     * Routing elements.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $routes = [
        '^.*/backend/accounting/receivable/list.*$'         => [['dest' => '\Modules\AccountsReceivable\Controller:viewDebitorList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/receivable/create.*$'       => [['dest' => '\Modules\AccountsReceivable\Controller:viewDebitorCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/receivable/profile.*$'      => [['dest' => '\Modules\AccountsReceivable\Controller:viewDebitorProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/receivable/outstanding.*$'  => [['dest' => '\Modules\AccountsReceivable\Controller:viewDebitorOutstanding', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/receivable/age.*$'          => [['dest' => '\Modules\AccountsReceivable\Controller:viewDebitorAge', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/receivable/receivable.*$'   => [['dest' => '\Modules\AccountsReceivable\Controller:viewDebitorPayable', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/receivable/dun/list.*$'     => [['dest' => '\Modules\AccountsReceivable\Controller:viewDebitorDunList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/receivable/dso/list.*$'     => [['dest' => '\Modules\AccountsReceivable\Controller:viewDebitorDsoList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/accounting/receivable/journal/list.*$' => [['dest' => '\Modules\AccountsReceivable\Controller:viewJournalList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
    ];

    /**
     * Providing.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $providing = [];

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
    public function viewDebitorList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/AccountsReceivable/Theme/Backend/debitor-list');
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
    public function viewDebitorCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/AccountsReceivable/Theme/Backend/debitor-create');
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
    public function viewDebitorProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/AccountsReceivable/Theme/Backend/debitor-profile');
        $view->addData('nav', $this->createNavigation(1000104001, $request, $response));

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
        $navView->setTemplate('/Modules/Navigation/Theme/Backend/mid');
        $navView->setNav($nav->getNav());
        $navView->setLanguage($request->getL11n()->language);
        $navView->setParent($pageId);

        return $navView;
    }
}
