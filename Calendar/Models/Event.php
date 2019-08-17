<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Calendar\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use phpOMS\Account\Account;
use phpOMS\Account\NullAccount;
use phpOMS\Stdlib\Base\Location;

/**
 * Event class.
 *
 * @package    Modules\Calendar\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
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
     * @var null|\DateTime
     * @since 1.0.0
     */
    private ?\DateTime $createdAt = null;

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    private $createdBy = 0;

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
     * @var null|int|Schedule
     * @since 1.0.0
     */
    private $schedule = null;

    /**
     * Location of the event.
     *
     * @var Location
     * @since 1.0.0
     */
    private ?Location $location = null;

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
     * @since  1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->location  = new Location();
        $this->schedule  = new Schedule();
    }

    /**
     * @return int
     *
     * @since  1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return Account[]
     *
     * @since  1.0.0
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
     * @since  1.0.0
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
     * @since  1.0.0
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
     * @since  1.0.0
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
     * @since  1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $desc Event description
     *
     * @since  1.0.0
     */
    public function setDescription(string $desc) : void
    {
        $this->description = $desc;
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
     * @return int
     *
     * @since  1.0.0
     */
    public function getCreatedBy() : int
    {
        return $this->createdBy;
    }

    /**
     * @param $createdBy Creator
     *
     * @since  1.0.0
     */
    public function setCreatedBy(int $createdBy) : void
    {
        $this->createdBy = $createdBy;
        $this->schedule->setCreatedBy($this->createdBy);
    }

    /**
     * @param Location $location Event location
     *
     * @since  1.0.0
     */
    public function setLocation(Location $location) : void
    {
        $this->location = $location;
    }

    /**
     * @return Location
     *
     * @since  1.0.0
     */
    public function getLocation() : Location
    {
        return $this->location;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     */
    public function getCalendar() : int
    {
        return $this->calendar;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @param int $calendar Calendar
     *
     * @since  1.0.0
     */
    public function setCalendar(int $calendar) : void
    {
        $this->calendar = $calendar;
    }

    /**
     * @return Schedule
     *
     * @since  1.0.0
     */
    public function getSchedule() : Schedule
    {
        return $this->schedule;
    }
}
