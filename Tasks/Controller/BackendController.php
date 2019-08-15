<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Tasks
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tasks\Controller;

use Modules\Tasks\Models\PermissionState;
use Modules\Tasks\Models\Task;
use Modules\Tasks\Models\TaskMapper;
use Modules\Tasks\Views\TaskView;

use phpOMS\Account\PermissionType;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\RelationType;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Backend controller for the tasks module.
 *
 * @package    Modules\Tasks
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
     * @return RenderableInterface Returns a renderable object
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewTaskDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Tasks/Theme/Backend/css/styles.css');

        $view->setTemplate('/Modules/Tasks/Theme/Backend/task-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        $tasks = TaskMapper::getAny($request->getHeader()->getAccount());

        $view->addData('tasks', $tasks);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Returns a renderable object
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Tasks/Theme/Backend/dashboard-task');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        $taskListView = new \Modules\Tasks\Theme\Backend\Components\Tasks\ListView($this->app, $request, $response);
        $taskListView->setTemplate('/Modules/Tasks/Theme/Backend/Components/Tasks/list');
        $view->addData('tasklist', $taskListView);

        $tasks = TaskMapper::getNewest(5, null, RelationType::ALL, 1);
        $view->addData('tasks', $tasks);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Returns a renderable object
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewTaskView(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new TaskView($this->app, $request, $response);

        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Tasks/Theme/Backend/css/styles.css');

        $task      = TaskMapper::get((int) $request->getData('id'), RelationType::ALL, null, 5);
        $accountId = $request->getHeader()->getAccount();

        if (!($task->getCreatedBy()->getId() === $accountId
            || $task->isCCAccount($accountId)
            || $task->isToAccount($accountId))
            && !$this->app->accountManager->get($accountId)->hasPermission(
                PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::TASK, $task->getId())
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Tasks/Theme/Backend/task-single');
        $view->addData('task', $task);
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        $accGrpSelector = new \Modules\Profile\Theme\Backend\Components\AccountGroupSelector\BaseView($this->app, $request, $response);
        $view->addData('accGrpSelector', $accGrpSelector);

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Returns a renderable object
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewTaskCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Tasks/Theme/Backend/task-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        $accGrpSelector = new \Modules\Profile\Theme\Backend\Components\AccountGroupSelector\BaseView($this->app, $request, $response);
        $view->addData('accGrpSelector', $accGrpSelector);

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Returns a renderable object
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewTaskAnalysis(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Tasks/Theme/Backend/task-analysis');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        return $view;
    }

    /**
     * Count unread messages
     *
     * @param int $account Account id
     *
     * @return int Returns the amount of unread tasks
     *
     * @since  1.0.0
     */
    public function openNav(int $account) : int
    {
        return TaskMapper::countUnread($account);
    }
}
