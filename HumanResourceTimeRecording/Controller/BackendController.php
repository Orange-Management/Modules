<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\HumanResourceTimeRecording
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\HumanResourceTimeRecording\Controller;

use Modules\HumanResourceTimeRecording\Models\SessionMapper;

use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;
use Modules\HumanResourceManagement\Models\EmployeeMapper;
use phpOMS\Stdlib\Base\SmartDateTime;
use phpOMS\Views\PaginationView;

/**
 * TimeRecording controller class.
 *
 * @package Modules\HumanResourceTimeRecording
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
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/HumanResourceTimeRecording/Theme/Backend/dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006301001, $request, $response));

        $list = SessionMapper::getLastSessionsFromAllEmployees(new \DateTime('now'));
        $view->addData('sessions', $list);

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
    public function viewPrivateDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/HumanResourceTimeRecording/Theme/Backend/private-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006303001, $request, $response));

        $employee        = EmployeeMapper::getFromAccount($request->getHeader()->getAccount())->getId();
        $lastOpenSession = SessionMapper::getMostPlausibleOpenSessionForEmployee($employee);

        $start = new SmartDateTime('now');
        $limit = $start->getEndOfMonth();
        $limit->smartModify(0, -2, 0);

        $list = SessionMapper::getSessionListForEmployee($employee, $start, 0);

        $view->addData('sessions', $list);
        $view->addData('lastSession', $lastOpenSession);
        $view->addData('date', $limit);

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
    public function viewPrivateSession(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/HumanResourceTimeRecording/Theme/Backend/private-session');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006303001, $request, $response));

        $session  = SessionMapper::get((int) $request->getData('id'));
        $employee = EmployeeMapper::getFromAccount($request->getHeader()->getAccount())->getId();

        if ($session->getEmployee()->getId() !== $employee) {
            $view->addData('session', new NullSession());
        } else {
            $view->addData('session', $session);
        }

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
    public function viewHRStats(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/HumanResourceTimeRecording/Theme/Backend/hr-stats');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006301001, $request, $response));

        $list = SessionMapper::getLastSessionsFromAllEmployees(new \DateTime('now'));
        $view->addData('sessions', $list);

        return $view;
    }
}
