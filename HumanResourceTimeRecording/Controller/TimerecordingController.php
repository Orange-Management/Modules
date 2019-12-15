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

/**
 * TimeRecording controller class.
 *
 * @package Modules\HumanResourceTimeRecording
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class TimerecordingController extends Controller
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
        $view->setTemplate('/Modules/HumanResourceTimeRecording/Theme/Timeterminal/overview');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006301001, $request, $response));

        $list = SessionMapper::getNewest(50);
        $view->addData('sessions', $list);

        return $view;
    }
}
