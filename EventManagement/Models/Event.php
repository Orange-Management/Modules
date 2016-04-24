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
namespace Modules\EventManagement\Models;

use Modules\Calendar\Models\Event as CalendarEvent;
use Modules\Tasks\Models\Task;
use phpOMS\Datatypes\Exception\InvalidEnumValue;
use phpOMS\Localization\Money;

/**
 * Event class.
 *
 * @category   EventManager
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Event
{

    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    private $type = EventType::DEFAULT;

    private $event = null;

    private $costs = null;

    private $budget = null;

    private $earnings = null;

    private $tasks = [];

    /**
     * Created.
     *
     * @var \Datetime
     * @since 1.0.0
     */
    private $createdAt = null;

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    private $createdBy = 0;

    public function __construct(string $name = '')
    {
        $this->event = new CalendarEvent();
        $this->costs = new Money();
        $this->budget = new Money();
        $this->earnings = new Money();
        $this->createdAt = new \DateTime('now');

        $this->setName($name);
    }

    public function getEvent() : CalendarEvent
    {
        return $this->event;
    }

    public function setName(string $name) 
    {
        $this->event->setName($name);
    }

    public function getName() : string
    {
        return $this->event->getName();
    }

    public function addTask(Task $task)
    {
        if($task->getId() !== 0) {
            $this->tasks[$task->getId()] = $task;
        } else {
            $this->tasks[] = $task;
        }
    }

    public function removeTask(int $id) : bool
    {
        if(isset($this->tasks[$id])) {
            unset($this->tasks[$id]);

            return true;
        }

        return false;
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
        return count($this->tasks);
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setType(int $type)
    {
        if(!EventType::isValidValue($type)) {
            throw new InvalidEnumValue($type);
        }

        $this->type = $type;
    }

    public function getType() : int
    {
        return $this->type;
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

    public function setCosts(Money $costs) 
    {
        $this->costs = $costs;
    }

    public function setBudget(Money $budget) 
    {
        $this->budget = $budget;
    }

    public function setEarnings(Money $earnings) 
    {
        $this->earnings = $earnings;
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
     * @param \DateTime $createdAt Event created at
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        $this->event->setCreatedAt($this->createdAt);
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreatedBy() : int
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy Creator
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreatedBy(int $createdBy)
    {
        $this->createdBy = $createdBy;
        $this->event->setCreatedBy($this->createdBy);
    }
}
