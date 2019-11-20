<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Support\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Support\Models;

use Modules\Tasks\Models\Task;
use Modules\Tasks\Models\TaskType;

/**
 * Issue class.
 *
 * @package Modules\Support\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Ticket
{
    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;

    private $task = null;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->task = new Task();
        $this->task->setType(TaskType::HIDDEN);
    }

    /**
     * Get id.
     *
     * @return int Model id
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get task.
     *
     * @return Task
     *
     * @since 1.0.0
     */
    public function getTask() : Task
    {
        return $this->task;
    }

    /**
     * Set task.
     *
     * @param Task $task Task
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTask(Task $task) : void
    {
        $this->task = $task;
    }
}
