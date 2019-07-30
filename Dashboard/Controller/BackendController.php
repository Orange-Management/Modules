<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Dashboard
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Dashboard\Controller;

use Modules\Dashboard\Models\DashboardBoardMapper;
use Modules\Dashboard\Models\NullDashboardBoard;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\NullModule;
use phpOMS\Views\View;

/**
 * Dashboard class.
 *
 * @package    Modules\Dashboard
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
    public function viewDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Dashboard/Theme/Backend/dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000301001, $request, $response));

        $board = DashboardBoardMapper::getFor($request->getHeader()->getAccount(), 'account');

        if ($board instanceof NullDashboardBoard) {
            $board = DashboardBoardMapper::get(1);
        }

        $panels          = [];
        $boardComponents = $board->getComponents();

        foreach ($boardComponents as $component) {
            $module = $this->app->moduleManager->get($component->getModule());

            // todo: check if this should be done with instanceof DashboardView -> instanceof DashboardView
            if ($module instanceof NullModule
                || !\method_exists($module, 'viewDashboard')
            ) {
                continue;
            }

            $panels[] = $module->viewDashboard($request, $response, $data);
        }

        $view->addData('panels', $panels);

        return $view;
    }
}
