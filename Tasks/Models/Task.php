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
use Modules\Tag\Models\NullTag;
use Modules\Tag\Models\Tag;
use phpOMS\Stdlib\Base\Exception\InvalidEnumValue;

/**
 * Task class.
 *
 * @package    Modules\Tasks
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Task implements \JsonSerializable
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
     * Task can be edited by user.
     *
     * @var bool
     * @since 1.0.0
     */
    protected $isEditable = true;

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
     * Task elements.
     *
     * @var Tag[]
     * @since 1.0.0
     */
    protected $tags = [];

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

    /**
     * Constructor.
     *
     * @since  1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->schedule  = new Schedule();
        $this->start     = new \DateTime('now');
        $this->due       = new \DateTime('now');
        $this->due->modify('+1 day');
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
     * Set editable
     *
     * Setting it to false will only allow other modules to close this task
     *
     * @param bool $editable Is editable
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setEditable(bool $editable) : void
    {
        $this->isEditable = $editable;
    }

    /**
     * Is editable
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function isEditable() : bool
    {
        return $this->isEditable;
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
     * Adding new tag.
     *
     * @param Tag $tag Tag
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function addTag(Tag $tag) : int
    {
        $this->tags[] = $tag;

        \end($this->tags);
        $key = (int) \key($this->tags);
        \reset($this->tags);

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
     * Check if user is in to
     *
     * @param int $id User id
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function isToAccount(int $id) : bool
    {
        foreach ($this->taskElements as $element) {
            if ($element->isToAccount($id)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if group is in to
     *
     * @param int $id Group id
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function isToGroup(int $id) : bool
    {
        foreach ($this->taskElements as $element) {
            if ($element->isToGroup($id)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user is in cc
     *
     * @param int $id User id
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function isCCAccount(int $id) : bool
    {
        foreach ($this->taskElements as $element) {
            if ($element->isCCAccount($id)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if group is in cc
     *
     * @param int $id Group id
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function isCCGroup(int $id) : bool
    {
        foreach ($this->taskElements as $element) {
            if ($element->isCCGroup($id)) {
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
     * @return int|\phpOMS\Account\Account
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
    public function setDescriptionRaw(string $description) : void
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
     * Remove Tag from list.
     *
     * @param int $id Tag
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function removeTag($id) : bool
    {
        if (isset($this->tags[$id])) {
            unset($this->tags[$id]);

            return true;
        }

        return false;
    }

    /**
     * Get task elements.
     *
     * @return Tag[]
     *
     * @since  1.0.0
     */
    public function getTags() : array
    {
        return $this->tags;
    }

    /**
     * Get task elements.
     *
     * @param int $id Element id
     *
     * @return Tag
     *
     * @since  1.0.0
     */
    public function getTag(int $id) : Tag
    {
        return $this->tags[$id] ?? new NullTag();
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
    public function setType(int $type = TaskType::SINGLE) : void
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
            'id'          => $this->id,
            'createdBy'   => $this->createdBy,
            'createdAt'   => $this->createdAt->format('Y-m-d H:i:s'),
            'title'       => $this->title,
            'description' => $this->description,
            'status'      => $this->status,
            'type'        => $this->type,
            'priority'    => $this->priority,
            'due'         => $this->due->format('Y-m-d H:i:s'),
            'done'        => (!isset($this->done) ? null : $this->done->format('Y-m-d H:i:s')),
            'elements'    => $this->taskElements,
            'tags'        => $this->tags,
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
