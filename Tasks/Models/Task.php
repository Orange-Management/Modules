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

namespace Modules\Tasks\Models;

use Modules\Calendar\Models\Schedule;
use phpOMS\Stdlib\Base\Exception\InvalidEnumValue;

/**
 * Task class.
 *
 * @package    Modules\Tasks
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class Task implements \JsonSerializable
{

    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected $id = 0;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    protected $title = '';

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    protected $createdBy = 0;

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected $createdAt = null;

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    protected $description = '';

    /**
     * Description raw.
     *
     * @var string
     * @since 1.0.0
     */
    protected $descriptionRaw = '';

    /**
     * Type.
     *
     * @var int
     * @since 1.0.0
     */
    protected $type = TaskType::SINGLE;

    /**
     * Status.
     *
     * @var int
     * @since 1.0.0
     */
    protected $status = TaskStatus::OPEN;

    /**
     * Task can be closed by user.
     *
     * @var bool
     * @since 1.0.0
     */
    protected $isClosable = true;

    /**
     * Start.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected $start = null;

    /**
     * Due.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected $due = null;

    /**
     * Done.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected $done = null;

    /**
     * Task elements.
     *
     * @var TaskElement[]
     * @since 1.0.0
     */
    protected $taskElements = [];

    /**
     * Schedule
     *
     * @var Schedule
     * @since 1.0.0
     */
    protected $schedule = null;

    /**
     * Priority
     *
     * @var int
     * @since 1.0.0
     */
    protected $priority = TaskPriority::NONE;

    /**
     * Media files
     *
     * @var array
     * @since 1.0.0
     */
    protected $media = [];

    protected $acc = [];

    /**
     * Constructor.
     *
     * @since  1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->start     = new \DateTime('now');
        $this->due       = new \DateTime('now');
        $this->due->modify('+1 day');
        $this->schedule = new Schedule();
    }

    /**
     * Set closable
     *
     * Setting it to false will only allow other modules to close this task
     *
     * @param bool $closable Is closable
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setClosable(bool $closable) : void
    {
        $this->isClosable = $closable;
    }

    /**
     * Is closable
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function isClosable() : bool
    {
        return $this->isClosable;
    }

    /**
     * Adding new task element.
     *
     * @param TaskElement $element Task element
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function addElement(TaskElement $element) : int
    {
        $this->taskElements[] = $element;

        \end($this->taskElements);
        $key = (int) \key($this->taskElements);
        \reset($this->taskElements);

        return $key;
    }

    /**
     * Get all media
     *
     * @return array<int|\Modules\Media\Models\Media>
     *
     * @since  1.0.0
     */
    public function getMedia() : array
    {
        return $this->media;
    }

    /**
     * Add media
     *
     * @param mixed $media Media to add
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function addMedia($media) : void
    {
        $this->media[] = $media;
    }

    /**
     * Check if user is cc
     *
     * @param int $id User id
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function isCc(int $id) : bool
    {
        return false;
    }

    /**
     * check if user is forwarded
     *
     * @param int $id User id
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function isForwarded(int $id) : bool
    {
        foreach ($this->taskElements as $element) {
            if ($element->getForwarded()->getId() === $id) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt ?? new \DateTime();
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getStart() : \DateTime
    {
        return $this->start ?? new \DateTime();
    }

    /**
     * Set start time of task
     *
     * @param \DateTime $start Start date of task
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setStart(\DateTime $start) : void
    {
        $this->start = $start;
    }

    /**
     * Get created by
     *
     * @return mixed
     *
     * @since  1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param mixed $id Created by
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setCreatedBy($id) : void
    {
        $this->createdBy = $id;
        $this->schedule->setCreatedBy($id);
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since  1.0.0
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
     * @since  1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * Set description
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setDescriptionRaw(string $description)
    {
        $this->descriptionRaw = $description;
    }

    /**
     * Get done date
     *
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getDone() : \DateTime
    {
        return $this->done ?? new \DateTime('now');
    }

    /**
     * Set done date
     *
     * @param \DateTime $done Done date
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setDone(\DateTime $done) : void
    {
        $this->done = $done;
    }

    /**
     * Get due date
     *
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getDue() : \DateTime
    {
        return $this->due;
    }

    /**
     * Set due date
     *
     * @param \DateTime $due Due date
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setDue(\DateTime $due) : void
    {
        $this->due = $due;
    }

    /**
     * Get id
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get status
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param int $status Task status
     *
     * @return void
     *
     * @throws InvalidEnumValue
     *
     * @since  1.0.0
     */
    public function setStatus(int $status) : void
    {
        if (!TaskStatus::isValidValue($status)) {
            throw new InvalidEnumValue((string) $status);
        }

        $this->status = $status;
    }

    /**
     * Get priority
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getPriority() : int
    {
        return $this->priority;
    }

    /**
     * Set priority
     *
     * @param int $priority Task priority
     *
     * @return void
     *
     * @throws InvalidEnumValue
     *
     * @since  1.0.0
     */
    public function setPriority(int $priority) : void
    {
        if (!TaskPriority::isValidValue($priority)) {
            throw new InvalidEnumValue((string) $priority);
        }

        $this->priority = $priority;
    }

    /**
     * Get title
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title Title
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     * Remove Element from list.
     *
     * @param int $id Task element
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function removeElement($id) : bool
    {
        if (isset($this->taskElements[$id])) {
            unset($this->taskElements[$id]);

            return true;
        }

        return false;
    }

    /**
     * Get task elements.
     *
     * @return TaskElement[]
     *
     * @since  1.0.0
     */
    public function getTaskElements() : array
    {
        return $this->taskElements;
    }

    /**
     * Get task elements.
     *
     * @param int $id Element id
     *
     * @return TaskElement
     *
     * @since  1.0.0
     */
    public function getTaskElement(int $id) : TaskElement
    {
        return $this->taskElements[$id] ?? new NullTaskElement();
    }

    /**
     * Get task type.
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Set task type.
     *
     * @param int $type Task type
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setType(int $type = TaskType::SINGLE)
    {
        $this->type = $type;
    }

    /**
     * Get schedule.
     *
     * @return Schedule
     *
     * @since  1.0.0
     */
    public function getSchedule() : Schedule
    {
        return $this->schedule;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'createdBy' => $this->createdBy,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'type' => $this->type,
            'priority' => $this->priority,
            'due' => $this->due->format('Y-m-d H:i:s'),
            'done' => (!isset($this->done) ? null : $this->done->format('Y-m-d H:i:s')),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
