<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tasks
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tasks\Controller;

use Modules\Tasks\Models\Task;

use Modules\Tasks\Models\TaskElement;
use Modules\Tasks\Models\TaskElementMapper;
use Modules\Tasks\Models\TaskMapper;
use Modules\Tasks\Models\TaskStatus;
use Modules\Tasks\Models\TaskType;

use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * Api controller for the tasks module.
 *
 * @package Modules\Tasks
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Validate task create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateTaskCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['plain'] = empty($request->getData('plain')))
            || ($val['due'] = !((bool) \strtotime((string) $request->getData('due'))))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaskCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateTaskCreate($request))) {
            $response->set($request->getUri()->__toString(), new FormValidation($val));

            return;
        }

        $task = $this->createTaskFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $task, TaskMapper::class, 'task');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Task', 'Task successfully created.', $task);
    }

    /**
     * Method to create task from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Task Returns the created task from the request
     *
     * @since 1.0.0
     */
    private function createTaskFromRequest(RequestAbstract $request) : Task
    {
        $task = new Task();
        $task->setTitle((string) ($request->getData('title') ?? ''));
        $task->setDescription(Markdown::parse((string) ($request->getData('plain') ?? '')));
        $task->setDescriptionRaw((string) ($request->getData('plain') ?? ''));
        $task->setCreatedBy($request->getHeader()->getAccount());
        $task->setDue(new \DateTime((string) ($request->getData('due') ?? 'now')));
        $task->setStatus(TaskStatus::OPEN);
        $task->setType(TaskType::SINGLE);
        $task->setPriority((int) $request->getData('priority'));

        $element = new TaskElement();
        $element->addTo((int) ($request->getData('forward') ?? $request->getHeader()->getAccount()));
        $element->setCreatedBy($task->getCreatedBy());
        $element->setDue($task->getDue());
        $element->setPriority($task->getPriority());
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
     * @since 1.0.0
     */
    public function apiTaskGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $task = TaskMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Task', 'Task successfully returned.', $task);
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
     * @since 1.0.0
     */
    public function apiTaskSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone TaskMapper::get((int) $request->getData('id'));
        $new = $this->updateTaskFromRequest($request);
        $this->updateModel($request, $old, $new, TaskMapper::class, 'task');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Task', 'Task successfully updated.', $new);
    }

    /**
     * Method to update an task from a request
     *
     * @param RequestAbstract $request Request
     *
     * @return Task Returns the updated task from the request
     *
     * @since 1.0.0
     */
    private function updateTaskFromRequest(RequestAbstract $request) : Task
    {
        $task = TaskMapper::get((int) ($request->getData('id')));
        $task->setTitle((string) ($request->getData('title') ?? $task->getTitle()));
        $task->setDescription(Markdown::parse((string) ($request->getData('plain') ?? $task->getDescriptionRaw())));
        $task->setDescriptionRaw((string) ($request->getData('plain') ?? $task->getDescriptionRaw()));
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
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateTaskElementCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['status'] = !TaskStatus::isValidValue((int) $request->getData('status')))
            || ($val['due'] = !((bool) \strtotime((string) $request->getData('due'))))
            || ($val['task'] = !(\is_numeric($request->getData('task'))))
            || ($val['forward'] = !(\is_numeric(empty($request->getData('forward')) ? $request->getHeader()->getAccount() : $request->getData('forward'))))
        ) { // todo: validate correct task
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a task element
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaskElementCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateTaskElementCreate($request))) {
            $response->set('task_element_create', new FormValidation($val));

            return;
        }

        $element = $this->createTaskElementFromRequest($request);
        $task    = TaskMapper::get($element->getTask());
        $task->setStatus($element->getStatus());
        $task->setPriority($element->getPriority());

        $this->createModel($request->getHeader()->getAccount(), $element, TaskElementMapper::class, 'taskelement');
        $this->updateModel($request, $task, $task, TaskMapper::class, 'task');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Task element', 'Task element successfully created.', $element);
    }

    /**
     * Method to create task element from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return TaskElement Returns the task created from the request
     *
     * @since 1.0.0
     */
    private function createTaskElementFromRequest(RequestAbstract $request) : TaskElement
    {
        $element = new TaskElement();
        $element->setCreatedBy($request->getHeader()->getAccount());
        $element->setDue(new \DateTime((string) ($request->getData('due') ?? 'now')));
        $element->setPriority((int) $request->getData('priority'));
        $element->setStatus((int) ($request->getData('status')));
        $element->setTask((int) ($request->getData('task')));
        $element->setDescription(Markdown::parse((string) ($request->getData('plain') ?? '')));
        $element->setDescriptionRaw((string) ($request->getData('plain') ?? ''));

        $tos = $request->getData('to') ?? $request->getHeader()->getAccount();
        if (!\is_array($tos)) {
            $tos = [$tos];
        }

        $ccs = $request->getData('cc') ?? [];
        if (!\is_array($ccs)) {
            $ccs = [$ccs];
        }

        foreach ($tos as $to) {
            $element->addTo((int) $to);
        }

        foreach ($ccs as $cc) {
            $element->addCC((int) $cc);
        }

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
     * @since 1.0.0
     */
    public function apiTaskElementGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $task = TaskElementMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Task element', 'Task element successfully returned.', $task);
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
     * @since 1.0.0
     */
    public function apiTaskElementSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone TaskElementMapper::get((int) $request->getData('id'));
        $new = $this->updateTaskElementFromRequest($request);
        $this->updateModel($request, $old, $new, TaskElementMapper::class, 'taskelement');
        // todo: update task if element status change had effect on task status!!!
        //$this->updateModel($request, $task, $task, TaskMapper::class, 'task');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Task element', 'Task element successfully updated.', $new);
    }

    /**
     * Method to update an task element from a request
     *
     * @param RequestAbstract $request Request
     *
     * @return TaskElement Returns the updated task element from the request
     *
     * @since 1.0.0
     */
    private function updateTaskElementFromRequest(RequestAbstract $request) : TaskElement
    {
        $element = TaskElementMapper::get((int) ($request->getData('id')));
        $element->setDue(new \DateTime((string) ($request->getData('due') ?? $element->getDue()->format('Y-m-d H:i:s'))));
        $element->setStatus((int) ($request->getData('status') ?? $element->getStatus()));
        $element->setDescription(Markdown::parse((string) ($request->getData('plain') ?? $element->getDescriptionRaw())));
        $element->setDescriptionRaw((string) ($request->getData('plain') ?? $element->getDescriptionRaw()));

        $tos = $request->getData('to') ?? $request->getHeader()->getAccount();
        if (!\is_array($tos)) {
            $tos = [$tos];
        }

        $ccs = $request->getData('cc') ?? [];
        if (!\is_array($ccs)) {
            $ccs = [$ccs];
        }

        foreach ($tos as $to) {
            $element->addTo($to);
        }

        foreach ($ccs as $cc) {
            $element->addCC($cc);
        }

        return $element;
    }
}
