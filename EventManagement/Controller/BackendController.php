<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\EventManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\EventManagement\Controller;

use Modules\EventManagement\Models\Event;
use Modules\EventManagement\Models\EventMapper;

use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Event Management controller class.
 *
 * @package Modules\EventManagement
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#102
 *  Goal definition
 *  While costs are universal the goal for promotions, events etc. is not.
 *  In some cases it could be sales in others it could be response rate etc.
 *  Implement a way to define goals and allow manual+system side evaluation.
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
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewEventManagementList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/EventManagement/Theme/Backend/eventmanagement-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004201001, $request, $response));

        $events = EventMapper::getNewest(25);
        $view->addData('events', $events);

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
    public function viewEventManagementCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/EventManagement/Theme/Backend/eventmanagement-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004201001, $request, $response));

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
    public function viewEventManagementProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css');

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/EventManagement/Theme/Backend/eventmanagement-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004201001, $request, $response));

        $taskListView = new \Modules\Tasks\Theme\Backend\Components\Tasks\ListView($this->app->l11nManager, $request, $response);
        $taskListView->setTemplate('/Modules/Tasks/Theme/Backend/Components/Tasks/list');
        $view->addData('tasklist', $taskListView);

        $calendarView = new \Modules\Calendar\Theme\Backend\Components\Calendar\BaseView($this->app->l11nManager, $request, $response);
        $calendarView->setTemplate('/Modules/Calendar/Theme/Backend/Components/Calendar/mini');
        $view->addData('calendar', $calendarView);

        $mediaListView = new \Modules\Media\Theme\Backend\Components\Media\BaseView($this->app->l11nManager, $request, $response);
        $mediaListView->setTemplate('/Modules/Media/Theme/Backend/Components/Media/list');
        $view->addData('medialist', $mediaListView);

        $event = EventMapper::get((int) $request->getData('id'));
        $view->addData('event', $event);

        return $view;
    }
}
