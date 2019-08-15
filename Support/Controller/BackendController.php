<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Support
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Support\Controller;

use Modules\Support\Models\TicketMapper;

use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

use phpOMS\Views\View;

/**
 * Support controller class.
 *
 * @package    Modules\Support
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class BackendController extends Controller
{

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewSupportList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Support/Theme/Backend/support-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002901101, $request, $response));

        $tickets = TicketMapper::getAll();
        $view->setData('tickets', $tickets);

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
     * @codeCoverageIgnore
     */
    public function viewSupportTicket(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Support/Theme/Backend/ticket-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002901101, $request, $response));

        $ticket = TicketMapper::get((int) $request->getData('id'));
        $view->addData('ticket', $ticket);

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
     * @codeCoverageIgnore
     */
    public function viewSupportCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Support/Theme/Backend/ticket-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002901101, $request, $response));

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
     * @codeCoverageIgnore
     */
    public function viewSupportAnalysis(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Support/Theme/Backend/support-analysis');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002901101, $request, $response));

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
     * @codeCoverageIgnore
     */
    public function viewSupportSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Support/Theme/Backend/support-settings');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002901101, $request, $response));

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
     * @codeCoverageIgnore
     */
    public function viewPrivateSupportDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Support/Theme/Backend/user-support-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1002901101, $request, $response));

        return $view;
    }
}
