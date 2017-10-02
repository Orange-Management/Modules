<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\EventManagement;

use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use Modules\EventManagement\Models\EventMapper;
use Modules\EventManagement\Models\Event;
use phpOMS\Asset\AssetType;

/**
 * Event Management controller class.
 *
 * @category   Modules
 * @package    Modules\EventManagement
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
    /* public */ const MODULE_NAME = 'EventManagement';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    /* public */ const MODULE_ID = 1004200000;

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
     */
    public function viewEventManagementList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/EventManagement/Theme/Backend/eventmanagement-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004201001, $request, $response));

        $events = EventMapper::getNewest(25);
        $view->addData('events', $events);

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
     */
    public function viewEventManagementCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/EventManagement/Theme/Backend/eventmanagement-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004201001, $request, $response));

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
     */
    public function viewEventManagementProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        /** @var Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, $request->getUri()->getBase() . 'Modules/Calendar/Theme/Backend/css/styles.css');

        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/EventManagement/Theme/Backend/eventmanagement-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004201001, $request, $response));

        $event = EventMapper::get((int) $request->getData('id'));
        $view->addData('event', $event);

        return $view;
    }

}
