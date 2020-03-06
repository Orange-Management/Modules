<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Calendar\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use phpOMS\Stdlib\Base\Location;

/**
 * Event class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Event
{
    /**
     * Calendar ID.
     *
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

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
     * @var Account
     * @since 1.0.0
     */
    private Account $createdBy;

    /**
     * Event type.
     *
     * Single event or a template (templates have a repeating)
     *
     * @var int
     * @since 1.0.0
     */
    private int $type = EventType::SINGLE;

    /**
     * Event status.
     *
     * Active, inactive etc.
     *
     * @var int
     * @since 1.0.0
     */
    private int $status = EventStatus::ACTIVE;

    /**
     * Schedule
     *
     * @var Schedule
     * @since 1.0.0
     */
    private Schedule $schedule;

    /**
     * Location of the event.
     *
     * @var Location
     * @since 1.0.0
     */
    private Location $location;

    /**
     * Calendar
     *
     * @var int
     * @since 1.0.0
     */
    private $calendar = null;

    /**
     * People.
     *
     * @var array
     * @since 1.0.0
     */
    private array $people = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdBy = new NullAccount();
        $this->createdAt = new \DateTime('now');
        $this->location  = new Location();
        $this->schedule  = new Schedule();
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return Account[]
     *
     * @since 1.0.0
     */
    public function getPeople() : array
    {
        return $this->people;
    }

    /**
     * @param int $id Account id
     *
     * @return Account
     *
     * @since 1.0.0
     */
    public function getPerson(int $id) : Account
    {
        return $this->people[$id] ?? new NullAccount();
    }

    /**
     * @param Account $person Person to add
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addPerson(Account $person) : void
    {
        $this->people[$person->getId()] = $person;
    }

    /**
     * Remove Element from list.
     *
     * @param int $id Task element
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removePerson(int $id) : bool
    {
        if (isset($this->people[$id])) {
            unset($this->people[$id]);

            return true;
        }

        return false;
    }

    /**
     * @param string $name Event name/title
     *
     * @since 1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $desc Event description
     *
     * @since 1.0.0
     */
    public function setDescription(string $desc) : void
    {
        $this->description = $desc;
    }

    /**
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy() : Account
    {
        return $this->createdBy;
    }

    /**
     * Set creator
     *
     * @param Account $createdBy Creator
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy(Account $createdBy) : void
    {
        $this->createdBy = $createdBy;

        if ($this->schedule instanceof Schedule) {
            $this->schedule->setCreatedBy($this->createdBy);
        }
    }

    /**
     * Set location
     *
     * @param Location $location Event location
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setLocation(Location $location) : void
    {
        $this->location = $location;
    }

    /**
     * @return Location
     *
     * @since 1.0.0
     */
    public function getLocation() : Location
    {
        return $this->location;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getCalendar() : int
    {
        return $this->calendar;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @param int $calendar Calendar
     *
     * @since 1.0.0
     */
    public function setCalendar(int $calendar) : void
    {
        $this->calendar = $calendar;
    }

    /**
     * @return Schedule
     *
     * @since 1.0.0
     */
    public function getSchedule() : Schedule
    {
        return $this->schedule;
    }
}
