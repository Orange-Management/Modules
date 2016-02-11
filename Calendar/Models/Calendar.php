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
namespace Modules\Calendar\Models;

/**
 * Calendar class.
 *
 * @category   Calendar
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Calendar
{

    /**
     * Calendar ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private $description = '';

    /**
     * Created at.
     *
     * @var \Datetime
     * @since 1.0.0
     */
    private $createdAt = null;

    /**
     * Created by.
     *
     * @var int
     * @since 1.0.0
     */
    private $createdBy = 0;

    private $date = null;

    /**
     * Events.
     *
     * @var \Modules\Calendar\Models\Event[]
     * @since 1.0.0
     */
    private $events = [];

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->date = new \DateTime('now');
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $desc)
    {
        $this->description = $desc;
    }

    public function addEvent(Event $event) : int
    {
        $this->events[] = $event;

        end($this->events);
        $key = key($this->events);
        reset($this->events);

        return $key;
    }

    public function getEvents() : array
    {
        return $this->events;
    }

    public function removeEvent($id) : bool
    {
        if (isset($this->events[$id])) {
            unset($this->events[$id]);

            return true;
        }

        return false;
    }

    public function getEvent($id) : Event
    {
        return $this->events[$id] ?? new NullEvent();
    }

    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedBy() : int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function getDate() : \DateTime {
        return $this->date;
    }

    public function setDate(\DateTime $date) {
        $this->date = $date;
    }

    public function getDaysOfMonth() : int {
        return cal_days_in_month(CAL_GREGORIAN, $this->date->format('m'), $this->date->format('Y'));
    }

    public function getFirstDay() {
        return getdate(mktime(null, null, null, $this->date->format('m'), 1, $this->date->format('Y')))['wday'];
    }
}
