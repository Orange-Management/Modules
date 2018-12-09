<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Job
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Job\Controller;

use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Utils\TaskSchedule\SchedulerAbstract;
use phpOMS\Utils\TaskSchedule\SchedulerFactory;
use phpOMS\Views\View;

/**
 * Task class.
 *
 * @package    Modules\Job
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class BackendController extends Controller
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
    public function viewJobList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Job/Theme/Backend/job-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005701001, $request, $response));

        SchedulerAbstract::guessBin();
        $scheduler = SchedulerFactory::create();
        $jobs      = $scheduler->getAllByName('Adobe', false);

        $view->addData('jobs', $jobs);

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
    public function viewJobCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Job/Theme/Backend/job-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005701001, $request, $response));

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
    public function viewJob(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Job/Theme/Backend/job-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005701001, $request, $response));

        SchedulerAbstract::setBin('c:/WINDOWS/system32/schtasks.exe');
        $scheduler = SchedulerFactory::create();
        $job       = $scheduler->getAllByName('Adobe', false);

        $view->addData('job', end($job));

        return $view;
    }
}
