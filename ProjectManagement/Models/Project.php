<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\ProjectManagement\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use Modules\Calendar\Models\Calendar;
use Modules\Tasks\Models\Task;
use phpOMS\Localization\Money;

/**
 * Project class.
 *
 * @package    Modules\ProjectManagement\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class Project
{
    private $id = 0;

    private $start = null;

    private $end = null;

    private $name = '';

    private $description = '';

    private $calendar = null;

    private $costs = null;

    private $budget = null;

    private $earnings = null;

    private $progress = 0;

    private $progressType = ProgressType::MANUAL;

    private $media = [];

    /**
     * Created at.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    private ?\DateTime $createdAt = null;

    /**
     * Created by.
     *
     * @var int
     * @since 1.0.0
     */
    private $createdBy = 0;

    private $tasks = [];

    public function __construct(string $name = '')
    {
        $this->start = new \DateTime('now');
        $this->end   = new \DateTime('now');
        $this->end->modify('+1 month');
        $this->createdAt = new \DateTime('now');

        $this->calendar = new Calendar();

        $this->costs    = new Money();
        $this->budget   = new Money();
        $this->earnings = new Money();

        $this->setName($name);
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getMedia() : array
    {
        return $this->media;
    }

    public function addMedia($media) : void
    {
        $this->media[] = $media;
    }

    public function addTask(Task $task) : void
    {
        if ($task->getId() !== 0) {
            $this->tasks[$task->getId()] = $task;
        } else {
            $this->tasks[] = $task;
        }
    }

    public function removeTask(int $id) : bool
    {
        if (isset($this->tasks[$id])) {
            unset($this->tasks[$id]);

            return true;
        }

        return false;
    }

    public function getProgress() : int
    {
        return $this->progress;
    }

    public function setProgress(int $progress) : void
    {
        $this->progress = $progress;
    }

    public function getProgressType() : int
    {
        return $this->progressType;
    }

    public function setProgressType(int $type) : void
    {
        $this->progressType = $type;
    }

    public function getTask(int $id) : Task
    {
        return $this->tasks[$id] ?? new Task();
    }

    public function getTasks() : array
    {
        return $this->tasks;
    }

    public function countTasks() : int
    {
        return \count($this->tasks);
    }

    public function getStart() : \DateTime
    {
        return $this->start;
    }

    public function setStart(\DateTime $start) : void
    {
        $this->start = $start;
    }

    public function setEnd(\DateTime $end) : void
    {
        $this->end = $end;
    }

    public function getEnd() : \DateTime
    {
        return $this->end;
    }

    public function getCalendar() : Calendar
    {
        return $this->calendar;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
        $this->calendar->setName($name);
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    public function getCosts() : Money
    {
        return $this->costs;
    }

    public function getBudget() : Money
    {
        return $this->budget;
    }

    public function getEarnings() : Money
    {
        return $this->earnings;
    }

    public function setCosts(Money $costs) : void
    {
        $this->costs = $costs;
    }

    public function setBudget(Money $budget) : void
    {
        $this->budget = $budget;
    }

    public function setEarnings(Money $earnings) : void
    {
        $this->earnings = $earnings;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     */
    public function getCreatedBy() : int
    {
        return $this->createdBy;
    }

    /**
     * @param $createdBy Creator
     *
     * @since  1.0.0
     */
    public function setCreatedBy(int $createdBy) : void
    {
        $this->createdBy = $createdBy;
    }
}
