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
namespace Modules\Tasks\Models;

/**
 * Task class.
 *
 * @category   Modules
 * @package    Tasks
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Task
{

    /**
     * ID.
     *
     * @var \int
     * @since 1.0.0
     */
    private $id = null;

    /**
     * Title.
     *
     * @var \string
     * @since 1.0.0
     */
    private $title = '';

    /**
     * Creator.
     *
     * @var \int
     * @since 1.0.0
     */
    private $createdBy = null;

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $createdAt = null;

    /**
     * Description.
     *
     * @var \string
     * @since 1.0.0
     */
    private $description = '';

    /**
     * Plain unparsed.
     *
     * @var \string
     * @since 1.0.0
     */
    private $plain = '';

    /**
     * Type.
     *
     * @var TaskType
     * @since 1.0.0
     */
    private $type = TaskType::TASK;

    /**
     * Status.
     *
     * @var TaskStatus
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
     * Done.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $done = null;

    /**
     * Task elements.
     *
     * @var TaskElement[]
     * @since 1.0.0
     */
    private $taskElements = [];

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * Adding new task element.
     *
     * @param TaskElement $element Task element
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addElement(TaskElement $element) : \bool
    {
        if (!isset($this->taskElements[$element->getId()])) {
            $this->taskElements[$element->getId()] = $element;

            return true;
        }

        return false;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreatedBy() : \int
    {
        return $this->createdBy;
    }

    /**
     * @return \string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDescription() : \string
    {
        return $this->description;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDone() : \DateTime
    {
        return $this->done;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDue() : \DateTime
    {
        return $this->due;
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId() : \int
    {
        return $this->id;
    }

    /**
     * @return TaskStatus
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus() : TaskStatus
    {
        return $this->status;
    }

    /**
     * @return \string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTitle() : \string
    {
        return $this->title;
    }

    /**
     * Remove Element from list.
     *
     * @param \int $id Task element
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removeElement($id) : \bool
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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTaskElements() : array
    {
        return $this->taskElements;
    }

    /**
     * Get task elements.
     *
     * @param \int $id Element id
     *
     * @return TaskElement
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTaskElement(\int $id) : TaskElement
    {
        return $this->taskElements[$id] ?? new NullTaskElement();
    }

    /**
     * Get task type.
     *
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getType() : \int
    {
        return $this->type;
    }

    /**
     * Get plain.
     *
     * @return \string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPlain() : \string
    {
        return $this->plain;
    }
}
