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

use phpOMS\Stdlib\Base\Exception\InvalidEnumValue;

/**
 * Task class.
 *
 * @package    Modules\Tasks
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class TaskElement implements \JsonSerializable
{

    /**
     * Id.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private $description = '';

    /**
     * Description raw.
     *
     * @var string
     * @since 1.0.0
     */
    private $descriptionRaw = '';

    /**
     * Task.
     *
     * @var int
     * @since 1.0.0
     */
    private $task = 0;

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $createdAt = null;

    /**
     * Status.
     *
     * @var int
     * @since 1.0.0
     */
    private $status = TaskStatus::OPEN;

    /**
     * Due.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $due = null;

    /**
     * Priority
     *
     * @var int
     * @since 1.0.0
     */
    protected $priority = TaskPriority::NONE;

    /**
     * Forwarded to.
     *
     * @var int
     * @since 1.0.0
     */
    private $forwarded = 0;

    /**
     * Media.
     *
     * @var array
     * @since 1.0.0
     */
    private $media = [];

    /**
     * Constructor.
     *
     * @since  1.0.0
     */
    public function __construct()
    {
        $this->due = new \DateTime('now');
        $this->due->modify('+1 day');
        $this->createdAt = new \DateTime('now');
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
     * @param mixed $creator Creator
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setCreatedBy($creator)
    {
        $this->createdBy = $creator;

        if ($this->forwarded === 0) {
            $this->setForwarded($this->createdBy);
        }
    }

    /**
     * Get all media
     *
     * @return array
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
     * Get description
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
     * Get forwarded
     *
     * @return mixed
     *
     * @since  1.0.0
     */
    public function getForwarded()
    {
        return $this->forwarded;
    }

    /**
     * Set forwarded
     *
     * @param mixed $forwarded Forward to
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setForwarded($forwarded) : void
    {
        $this->forwarded = $forwarded;
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
     * Set Status
     *
     * @param int $status Task element status
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
     * Get task id
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getTask() : int
    {
        return $this->task;
    }

    /**
     * Set task i
     *
     * @param int $task Task id
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setTask(int $task)
    {
        $this->task = $task;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'task' => $this->task,
            'createdBy' => $this->createdBy,
            'createdAt' => $this->createdAt,
            'description' => $this->description,
            'status' => $this->status,
            'forward' => $this->forwarded,
            'due' => isset($this->due) ? $this->due->format('Y-m-d H:i:s') : null,
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
