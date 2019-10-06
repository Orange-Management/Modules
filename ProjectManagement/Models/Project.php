<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\ProjectManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use Modules\Calendar\Models\Calendar;
use Modules\Tasks\Models\Task;
use phpOMS\Localization\Money;

/**
 * Project class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Project
{
    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Start date.
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    private \DateTime $start;

    /**
     * End date.
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    private \DateTime $end;

    /**
     * Estimated end date.
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    private \DateTime $endEstimated;

    /**
     * Project name.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Project description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Project raw description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $descriptionRaw = '';

    /**
     * Calendar.
     *
     * @var   int|Calendar
     * @since 1.0.0
     */
    private $calendar;

    /**
     * Current total costs.
     *
     * @var   Money
     * @since 1.0.0
     */
    private Money $costs;

    /**
     * Budget costs.
     *
     * @var   Money
     * @since 1.0.0
     */
    private Money $budgetCosts;

    /**
     * Budget earnings.
     *
     * @var   Money
     * @since 1.0.0
     */
    private Money $budgetEarnings;

    /**
     * Current total earnings.
     *
     * @var   Money
     * @since 1.0.0
     */
    private Money $earnings;

    /**
     * Progress percentage.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $progress = 0;

    /**
     * Progress calculation.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $progressType = ProgressType::MANUAL;

    /**
     * Media files.
     *
     * @var   Media[]
     * @since 1.0.0
     */
    private array $media = [];

    /**
     * Created at.
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    private \DateTime $createdAt;

    /**
     * Created by.
     *
     * @var   int
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Tasks.
     *
     * @var   Tasks[]
     * @since 1.0.0
     */
    private $tasks = [];

    /**
     * Constructor.
     *
     * @param string $name Name of the project
     *
     * @since 1.0.0
     */
    public function __construct(string $name = '')
    {
        $this->start = new \DateTime('now');
        $this->end   = new \DateTime('now');
        $this->end->modify('+1 month');

        $this->endEstimated = clone $this->end;
        $this->createdAt    = new \DateTime('now');

        $this->calendar = new Calendar();

        $this->costs          = new Money();
        $this->budgetCosts    = new Money();
        $this->budgetEarnings = new Money();
        $this->earnings       = new Money();

        $this->setName($name);
    }

    /**
     * Get id.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get all media files.
     *
     * @return Media[]
     *
     * @since 1.0.0
     */
    public function getMedias() : array
    {
        return $this->media;
    }

    /**
     * Add media
     *
     * @param int|Media $media Media
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addMedia($media) : void
    {
        if ($media->getId() !== 0) {
            $this->media[$media->getId()] = $media;
        } else {
            $this->media[] = $media;
        }
    }

    /**
     * Remove media
     *
     * @param int $id Media id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeMedia(int $id) : bool
    {
        if (isset($this->media[$id])) {
            unset($this->media[$id]);

            return true;
        }

        return false;
    }

    /**
     * Add task
     *
     * @param int|Task $task Task
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
     * @param int $id Task id
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
     * Get progress
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
     * Set progress
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
     * Get progress type
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
     * Set progress type
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
     * Get task
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
     * Get media
     *
     * @param int $id Media id
     *
     * @return Media
     *
     * @since 1.0.0
     */
    public function getMedia(int $id) : Media
    {
        return $this->media[$id] ?? new Task();
    }

    /**
     * Get tasks
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public function getTasks() : array
    {
        return $this->tasks;
    }

    /**
     * Count tasks
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
     * Count media
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function countMedia() : int
    {
        return \count($this->media);
    }

    /**
     * Get start date
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
     * Set start date
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
     * Set end date
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
     * Get end date
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
     * Set estimated end date
     *
     * @param \DateTime $end End date
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setEstimatedEnd(\DateTime $end) : void
    {
        $this->end = $end;
    }

    /**
     * Get estimated end date
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getEstimatedEnd() : \DateTime
    {
        return $this->end;
    }

    /**
     * Get calendar
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
     * Set name
     *
     * @param string $name Project name
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
        $this->calendar->setName($name);
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
     * Set Description
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
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * Set Description
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescriptionRaw(string $description) : void
    {
        $this->descriptionRaw = $description;
    }

    /**
     * Get costs
     *
     * @return Money
     *
     * @sicne 1.0.0
     */
    public function getCosts() : Money
    {
        return $this->costs;
    }

    /**
     * Get budget costs
     *
     * @return Money
     *
     * @sicne 1.0.0
     */
    public function getBudgetCosts() : Money
    {
        return $this->budgetCosts;
    }

    /**
     * Get budget earnings
     *
     * @return Money
     *
     * @sicne 1.0.0
     */
    public function getBudgetEarnings() : Money
    {
        return $this->budgetEarnings;
    }

    /**
     * Get earnings
     *
     * @return Money
     *
     * @sicne 1.0.0
     */
    public function getEarnings() : Money
    {
        return $this->earnings;
    }

    /**
     * Set costs
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
     * Set budget costs
     *
     * @param Money $budget Budget
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setBudgetCosts(Money $budget) : void
    {
        $this->budgetCosts = $budget;
    }

    /**
     * Set budget earnings
     *
     * @param Money $budget Budget
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setBudgetEarnings(Money $budget) : void
    {
        $this->budgetEarnings = $budget;
    }

    /**
     * Set earnings
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
     * Get created at
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
     * Get created by
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getCreatedBy() : int
    {
        return $this->createdBy;
    }

    /**
     * Set created by
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
