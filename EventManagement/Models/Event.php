<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\EventManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\EventManagement\Models;

use Modules\Calendar\Models\Calendar;
use Modules\Tasks\Models\Task;
use phpOMS\Localization\Money;
use phpOMS\Stdlib\Base\Exception\InvalidEnumValue;

/**
 * Event class.
 *
 * @package Modules\EventManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Event
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

    private int $type = EventType::DEFAULT;

    private $start = null;

    private $end = null;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private string $name = '';
    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    private $calendar = null;

    private $costs = null;

    private $budget = null;

    private $earnings = null;

    private $tasks = [];

    private $media = [];

    private $progress = 0;

    private $progressType = ProgressType::MANUAL;

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private \DateTime $createdAt;

    /**
     * Creator.
     *
     * @var int|\Modules\Admin\Models\Account
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Constructor.
     *
     * @param string $name Event name/title
     *
     * @since 1.0.0
     */
    public function __construct(string $name = '')
    {
        $this->start     = new \DateTime('now');
        $this->end       = (new \DateTime('now'))->modify('+1 month');
        $this->calendar  = new Calendar();
        $this->costs     = new Money();
        $this->budget    = new Money();
        $this->earnings  = new Money();
        $this->createdAt = new \DateTime('now');

        $this->setName($name);
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
     * Get media files.
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getMedia() : array
    {
        return $this->media;
    }

    /**
     * Add media file.
     *
     * @param mixed $media Media
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addMedia($media) : void
    {
        $this->media[] = $media;
    }

    /**
     * Get start date.
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getStart() : \DateTime
    {
        return $this->start;
    }

    /**
     * Set start date.
     *
     * @param \DateTime $start Start date
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setStart(\DateTime $start) : void
    {
        $this->start = $start;
    }

    /**
     * Set end.
     *
     * @param \DateTime $end End date
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setEnd(\DateTime $end) : void
    {
        $this->end = $end;
    }

    /**
     * Get end.
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getEnd() : \DateTime
    {
        return $this->end;
    }

    /**
     * Get progress.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getProgress() : int
    {
        return $this->progress;
    }

    /**
     * Set progress.
     *
     * @param int $progress Progress
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setProgress(int $progress) : void
    {
        $this->progress = $progress;
    }

    /**
     * Get progress type.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getProgressType() : int
    {
        return $this->progressType;
    }

    /**
     * Set progress type.
     *
     * @param int $type Progress type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setProgressType(int $type) : void
    {
        $this->progressType = $type;
    }

    /**
     * Get calendar.
     *
     * @return Calendar
     *
     * @since 1.0.0
     */
    public function getCalendar() : Calendar
    {
        return $this->calendar;
    }

    /**
     * Set description
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set name
     *
     * @param string $name Name
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Add task.
     *
     * @param Task $task Task
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addTask(Task $task) : void
    {
        if ($task->getId() !== 0) {
            $this->tasks[$task->getId()] = $task;
        } else {
            $this->tasks[] = $task;
        }
    }

    /**
     * Remove task
     *
     * @param int $id id to remove
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeTask(int $id) : bool
    {
        if (isset($this->tasks[$id])) {
            unset($this->tasks[$id]);

            return true;
        }

        return false;
    }

    /**
     * Get task by id.
     *
     * @param int $id Task id
     *
     * @return Task
     *
     * @since 1.0.0
     */
    public function getTask(int $id) : Task
    {
        return $this->tasks[$id] ?? new Task();
    }

    /**
     * Get tasks.
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getTasks() : array
    {
        return $this->tasks;
    }

    /**
     * Count tasks.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function countTasks() : int
    {
        return \count($this->tasks);
    }

    /**
     * Set type
     *
     * @param int $type Type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setType(int $type) : void
    {
        if (!EventType::isValidValue($type)) {
            throw new InvalidEnumValue($type);
        }

        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Get costs.
     *
     * @return Money
     *
     * @since 1.0.0
     */
    public function getCosts() : Money
    {
        return $this->costs;
    }

    /**
     * Get budget.
     *
     * @return Money
     *
     * @since 1.0.0
     */
    public function getBudget() : Money
    {
        return $this->budget;
    }

    /**
     * Get earnings.
     *
     * @return Money
     *
     * @since 1.0.0
     */
    public function getEarnings() : Money
    {
        return $this->earnings;
    }

    /**
     * Set costs.
     *
     * @param Money $costs Costs
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCosts(Money $costs) : void
    {
        $this->costs = $costs;
    }

    /**
     * Set budget.
     *
     * @param Money $budget Budget
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setBudget(Money $budget) : void
    {
        $this->budget = $budget;
    }

    /**
     * Set earnings.
     *
     * @param Money $earnings Earnings
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setEarnings(Money $earnings) : void
    {
        $this->earnings = $earnings;
    }

    /**
     * get created at
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Get creator
     *
     * @return int|\Modules\Admin\Models\Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set creator
     *
     * @param int $createdBy Creator
     *
     * @since 1.0.0
     */
    public function setCreatedBy(int $createdBy) : void
    {
        $this->createdBy = $createdBy;
    }
}
