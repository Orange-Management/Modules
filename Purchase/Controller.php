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
namespace Modules\Purchase;

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
 * Purchase controller class.
 *
 * @category   Modules
 * @package    Modules\Purchase
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
    const MODULE_NAME = 'Purchase';

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
    ];

    /**
     * Routing elements.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $routes = [
        '^.*/backend/purchase/invoice/create.*$' => [['dest' => '\Modules\Purchase\Controller:viewPurchaseInvoiceCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/purchase/invoice/list.*$'   => [['dest' => '\Modules\Purchase\Controller:viewPurchaseInvoiceList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/backend/purchase/article/list.*$'      => [['dest' => '\Modules\Purchase\Controller:viewPurchaseArticleList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/purchase/article/recommend.*$' => [['dest' => '\Modules\Purchase\Controller:viewPurchaseOrderRecommendation', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/purchase/article/create.*$'    => [['dest' => '\Modules\Purchase\Controller:viewPurchaseArticleCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/purchase/article/profile.*$'   => [['dest' => '\Modules\Purchase\Controller:viewPurchaseArticleProfile', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
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
    public function viewPurchaseInvoiceList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Purchase/Theme/Backend/invoice-list');
        $view->addData('nav', $this->createNavigation(1003001001, $request, $response));

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
    public function viewPurchaseInvoiceCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Purchase/Theme/Backend/invoice-create');
        $view->addData('nav', $this->createNavigation(1003001001, $request, $response));

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
    public function viewPurchaseArticleList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Purchase/Theme/Backend/article-list');
        $view->addData('nav', $this->createNavigation(1003001001, $request, $response));

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
    public function viewPurchaseArticleCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Purchase/Theme/Backend/article-create');
        $view->addData('nav', $this->createNavigation(1003001001, $request, $response));

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
    public function viewPurchaseArticleProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Purchase/Theme/Backend/article-profile');
        $view->addData('nav', $this->createNavigation(1003001001, $request, $response));

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
    public function viewPurchaseOrderRecommendation(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Purchase/Theme/Backend/article-order-recommendation');
        $view->addData('nav', $this->createNavigation(1003001001, $request, $response));

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
