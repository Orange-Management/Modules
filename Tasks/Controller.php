<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Tasks
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Tasks;

use Model\Message\FormValidation;

use Modules\Tasks\Models\Task;
use Modules\Tasks\Models\TaskElement;
use Modules\Tasks\Models\TaskElementMapper;
use Modules\Tasks\Models\TaskMapper;
use Modules\Tasks\Models\TaskStatus;
use Modules\Tasks\Models\TaskType;
use Modules\Tasks\Models\TaskPriority;
use Modules\Tasks\Models\PermissionState;
use Modules\Tasks\Views\TaskView;

use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Utils\Parser\Markdown\Markdown;
use phpOMS\Views\View;
use phpOMS\Account\PermissionType;
use phpOMS\DataStorage\Database\RelationType;

/**
 * Task class.
 *
 * @package    Modules\Tasks
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
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
    public const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_NAME = 'Tasks';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1001100000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $providing = [
        'Navigation'
    ];

    /**
     * Dependencies.
     *
     * @var string[]
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
     * @codeCoverageIgnore
     */
    public function viewTaskDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
                PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DASHBOARD)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Tasks/Theme/Backend/task-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        $tasks = TaskMapper::getNewest(25);
        $view->addData('tasks', $tasks);

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
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Tasks/Theme/Backend/dashboard-task');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        $taskListView = new \Modules\Tasks\Theme\Backend\Components\Tasks\BaseView($this->app, $request, $response);
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
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewTaskView(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new TaskView($this->app, $request, $response);

        $task      = TaskMapper::get((int) $request->getData('id'));
        $accountId = $request->getHeader()->getAccount();

        if (!($task->getCreatedBy()->getId() === $accountId
            || $task->isCc($accountId)
            || $task->isForwarded($accountId))
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
    public function viewTaskCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::TASK)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

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
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewTaskAnalysis(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Tasks/Theme/Backend/task-analysis');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        return $view;
    }

    /**
     * Validate task create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function validateTaskCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['description'] = empty($request->getData('description')))
            || ($val['due'] = !((bool) strtotime((string) $request->getData('due'))))
            || ($val['forward'] = !(is_numeric($request->getData('forward') ?? 0)))
        ) {
            return $val;
        }

        return [];
    }

    public function openNav(int $account) : int
    {
        return TaskMapper::countUnread($account);
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTaskCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::TASK)
        ) {
            $response->set('task_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateTaskCreate($request))) {
            $response->set('task_create', new FormValidation($val));

            return;
        }

        $task = $this->createTaskFromRequest($request);

        TaskMapper::create($task);
        $response->set($request->getUri()->__toString(), $task->jsonSerialize());
    }

    /**
     * Method to create task from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Task
     *
     * @since  1.0.0
     */
    private function createTaskFromRequest(RequestAbstract $request) : Task
    {
        $task = new Task();
        $task->setTitle((string) ($request->getData('title') ?? ''));
        $task->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));
        $task->setDescriptionRaw((string) ($request->getData('description') ?? ''));
        $task->setCreatedBy($request->getHeader()->getAccount());
        $task->setDue(new \DateTime((string) ($request->getData('due') ?? 'now')));
        $task->setStatus(TaskStatus::OPEN);
        $task->setType(TaskType::SINGLE);
        $task->setPriority(TaskPriority::NONE);

        $element = new TaskElement();
        $element->setForwarded((int) ($request->getData('forward') ?? $request->getHeader()->getAccount()));
        $element->setCreatedBy($task->getCreatedBy());
        $element->setDue($task->getDue());
        $element->setStatus(TaskStatus::OPEN);

        $task->addElement($element);

        return $task;
    }

    /**
     * Api method to get a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTaskGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::TASK)
        ) {
            $response->set('task_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $task = TaskMapper::get((int) $request->getData('id'));
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Task',
            'message' => 'Task successfully returned.',
            'response' => $task->jsonSerialize()
        ]);
    }

    /**
     * Api method to update a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTaskSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::TASK)
        ) {
            $response->set('task_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $task   = $this->updateTaskFromRequest($request);
        $status = TaskMapper::update($task);

        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Task',
            'message' => 'Task successfully updated.',
            'response' => $task->jsonSerialize()
        ]);
    }

    /**
     * Method to update an task from a request
     *
     * @param RequestAbstract $request Request
     *
     * @return Task
     *
     * @since  1.0.0
     */
    private function updateTaskFromRequest(RequestAbstract $request) : Task
    {
        $task = TaskMapper::get((int) ($request->getData('id')));
        $task->setTitle((string) ($request->getData('title') ?? $task->getTitle()));
        $task->setDescription(Markdown::parse((string) ($request->getData('description') ?? $task->getDescriptionRaw())));
        $task->setDescriptionRaw((string) ($request->getData('description') ?? $task->getDescriptionRaw()));
        $task->setDue(new \DateTime((string) ($request->getData('due') ?? $task->getDue()->format('Y-m-d H:i:s'))));
        $task->setStatus((int) ($request->getData('status') ?? $task->getStatus()));
        $task->setType((int) ($request->getData('type') ?? $task->getType()));
        $task->setPriority((int) ($request->getData('priority') ?? $task->getPriority()));

        return $task;
    }

    /**
     * Validate task element create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function validateTaskElementCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['status'] = !TaskStatus::isValidValue((int) $request->getData('status')))
            || ($val['due'] = !((bool) strtotime((string) $request->getData('due'))))
            || ($val['task'] = !(is_numeric($request->getData('task'))))
            || ($val['forward'] = !(is_numeric(empty($request->getData('forward')) ? $request->getHeader()->getAccount() : $request->getData('forward'))))
        ) { // todo: validate correct task
            return $val;
        }

        return [];
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTaskElementCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::TASK)
        ) {
            $response->set('task_element_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateTaskElementCreate($request))) {
            $response->set('task_element_create', new FormValidation($val));

            return;
        }

        $element = $this->createTaskElementFromRequest($request);

        TaskElementMapper::create($element);
        $response->set($request->getUri()->__toString(), $element->jsonSerialize());
    }

    /**
     * Method to create task element from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return TaskElement
     *
     * @since  1.0.0
     */
    private function createTaskElementFromRequest(RequestAbstract $request) : TaskElement
    {
        $element = new TaskElement();
        $element->setForwarded((int) ($request->getData('forward') ?? $request->getHeader()->getAccount()));
        $element->setCreatedBy($request->getHeader()->getAccount());
        $element->setDue(new \DateTime((string) ($request->getData('due') ?? 'now')));
        $element->setStatus((int) ($request->getData('status')));
        $element->setTask((int) ($request->getData('task')));
        $element->setDescription(Markdown::parse((string) ($request->getData('description'))));
        $element->setDescriptionRaw((string) ($request->getData('description')));

        return $element;
    }

    /**
     * Api method to get a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTaskElementGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::TASK)
        ) {
            $response->set('task_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $task = TaskElementMapper::get((int) $request->getData('id'));
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Task',
            'message' => 'Task successfully returned.',
            'response' => $task->jsonSerialize()
        ]);
    }

    /**
     * Api method to update a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTaskElementSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::TASK)
        ) {
            $response->set('task_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $task   = $this->updateTaskElementFromRequest($request);
        $status = TaskElementMapper::update($task);

        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Task element',
            'message' => 'Task element successfully updated.',
            'response' => $task->jsonSerialize()
        ]);
    }

    /**
     * Method to update an task element from a request
     *
     * @param RequestAbstract $request Request
     *
     * @return TaskElement
     *
     * @since  1.0.0
     */
    private function updateTaskElementFromRequest(RequestAbstract $request) : TaskElement
    {
        $element = TaskElementMapper::get((int) ($request->getData('id')));
        $element->setForwarded((int) ($request->getData('forward') ?? $element->getForwarded()));
        $element->setDue(new \DateTime((string) ($request->getData('due') ?? $element->getDue()->format('Y-m-d H:i:s'))));
        $element->setStatus((int) ($request->getData('status') ?? $element->getStatus()));
        $element->setDescription(Markdown::parse((string) ($request->getData('description') ?? $element->getDescriptionRaw())));
        $element->setDescriptionRaw((string) ($request->getData('description') ?? $element->getDescriptionRaw()));

        return $task;
    }
}
