<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Calendar
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Calendar\Controller;

use Modules\Calendar\Models\CalendarMapper;
use Modules\Calendar\Models\PermissionState;
use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;

use phpOMS\Contract\RenderableInterface;
use phpOMS\Stdlib\Base\SmartDateTime;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Asset\AssetType;
use phpOMS\Account\PermissionType;
use phpOMS\Message\Http\RequestStatusCode;

/**
 * Calendar controller class.
 *
 * @package    Modules\Calendar
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class BackendController extends Controller
{
    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewCalendarDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        /** @var Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css');

        $view->setTemplate('/Modules/Calendar/Theme/Backend/calendar-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001201001, $request, $response));

        $calendar = CalendarMapper::get(1);
        $calendar->setDate(new SmartDateTime((string) ($request->getData('date') ?? 'now')));
        $view->addData('calendar', $calendar);

        $calendarEventPopup = new \Modules\Calendar\Theme\Backend\Components\Event\BaseView($this->app, $request, $response);
        $view->addData('calendarEventPopup', $calendarEventPopup);

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
     * @codeCoverageIgnore
     */
    public function viewDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        /** @var Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css');

        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Calendar/Theme/Backend/dashboard-calendar');

        $calendarView = new \Modules\Calendar\Theme\Backend\Components\Calendar\BaseView($this->app, $request, $response);
        $calendarView->setTemplate('/Modules/Calendar/Theme/Backend/Components/Calendar/mini');
        $view->addData('calendar', $calendarView);

        $calendar = CalendarMapper::get(1);
        $calendar->setDate(new SmartDateTime((string) ($request->getData('date') ?? 'now')));
        $view->addData('cal', $calendar);

        return $view;
    }
}