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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Calendar\Models;

use phpOMS\Datatypes\SmartDateTime;

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

    /**
     * Current date of the calendar.
     *
     * @var SmartDateTime
     * @since 1.0.0
     */
    private $date = null;

    /**
     * Password
     *
     * @var string
     * @since 1.0.0
     */
    private $password = null;

    /**
     * Events.
     *
     * @var \Modules\Calendar\Models\Event[]
     * @since 1.0.0
     */
    private $events = [];

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->date      = new SmartDateTime('now');
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name Calendar name/title
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password Calendar password/title
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $desc Calendar description
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDescription(string $desc)
    {
        $this->description = $desc;
    }

    /**
     * @param Event $event Calendar event
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addEvent(Event $event) : int
    {
        $this->events[] = $event;

        end($this->events);
        $key = key($this->events);
        reset($this->events);

        return $key;
    }

    /**
     * @return Event[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getEvents() : array
    {
        return $this->events;
    }

    /**
     * @param int $id Event id
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removeEvent(int $id) : bool
    {
        if (isset($this->events[$id])) {
            unset($this->events[$id]);

            return true;
        }

        return false;
    }

    /**
     * @param int $id Event id
     *
     * @return Event
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getEvent(int $id) : Event
    {
        return $this->events[$id] ?? new NullEvent();
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
     * @param \DateTime $createdAt Calendar created at
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
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
    }

    /**
     * Get current date
     *
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDate() : \DateTime
    {
        return $this->date;
    }

    /**
     * Set current date
     *
     * @param \DateTime $date Current date
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * Get event by date
     *
     * @param \DateTime $date Date of the event
     *
     * @return Event[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getEventByDate(\DateTime $date) : array
    {
        $events = [];
        foreach ($this->events as $event) {
            if ($event->getCreatedAt()->format('Y-m-d') === $date->format('Y-m-d')) {
                $events[] = $event;
            }
        }

        return $events;
    }
}
