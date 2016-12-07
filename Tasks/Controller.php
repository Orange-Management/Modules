<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Tasks;

use Model\Message\FormValidation;
use Model\Message\Redirect;
use Model\Message\Reload;
use Modules\Tasks\Models\Task;
use Modules\Tasks\Models\TaskElement;
use Modules\Tasks\Models\TaskElementMapper;
use Modules\Tasks\Models\TaskMapper;
use Modules\Tasks\Models\TaskStatus;
use Modules\Tasks\Models\TaskType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Uri\UriFactory;
use phpOMS\Views\View;

/**
 * Task class.
 *
 * @category   Modules
 * @package    Modules\Tasks
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
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
    /* public */ const MODULE_NAME = 'Tasks';

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewTaskDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewTaskView(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Tasks/Theme/Backend/task-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        $task = TaskMapper::get((int) $request->getData('id'));
        $view->addData('task', $task);

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewTaskCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Tasks/Theme/Backend/task-create');
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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewTaskAnalysis(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Tasks/Theme/Backend/task-analysis');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001101001, $request, $response));

        return $view;
    }

    private function validateTaskCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (
            ($val['title'] = empty($request->getData('title')))
            || ($val['description'] = empty($request->getData('description')))
            || ($val['due'] = !((bool)strtotime($request->getData('due'))))
            || ($val['forward'] = !(is_numeric($request->getData('forward') ?? 0)))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiTaskCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!empty($val = $this->validateTaskCreate($request))) {
            $response->set('task_create', new FormValidation($val));

            return;
        }

        $task = new Task();
        $task->setTitle($request->getData('title') ?? '');
        $task->setDescription($request->getData('description') ?? '');
        $task->setCreatedBy($request->getAccount());
        $task->setCreatedAt(new \DateTime('now'));
        $task->setDue(new \DateTime($request->getData('due') ?? 'now'));
        $task->setStatus(TaskStatus::OPEN);
        $task->setType(TaskType::SINGLE);

        $element = new TaskElement();
        $element->setForwarded($request->getData('forward') ?? $request->getAccount());
        $element->setCreatedAt($task->getCreatedAt());
        $element->setCreatedBy($task->getCreatedBy());
        $element->setDue($task->getDue());
        $element->setStatus(TaskStatus::OPEN);

        $task->addElement($element);

        TaskMapper::create($task);
        $response->set($request->__toString(), $task->jsonSerialize());
    }

    private function validateTaskElementCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (
            ($val['status'] = !TaskStatus::isValidValue((int) $request->getData('status')))
            || ($val['due'] = !((bool)strtotime($request->getData('due'))))
            || ($val['task'] = !(is_numeric($request->getData('task'))))
            || ($val['forward'] = !(is_numeric(empty($request->getData('forward')) ? $request->getAccount() : $request->getData('forward'))))
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
     * @return \Serializable
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiTaskElementCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!empty($val = $this->validateTaskElementCreate($request))) {
            $response->set('task_element_create', new FormValidation($val));

            return;
        }

        $element = new TaskElement();
        $element->setForwarded($request->getData('forward') ?? $request->getAccount());
        $element->setCreatedAt(new \DateTime('now'));
        $element->setCreatedBy($request->getAccount());
        $element->setDue(new \DateTime($request->getData('due') ?? 'now'));
        $element->setStatus($request->getData('status'));
        $element->setTask($request->getData('task'));
        $element->setDescription($request->getData('description'));

        TaskElementMapper::create($element);
        $response->set($request->__toString(), $element->jsonSerialize());
    }

}
