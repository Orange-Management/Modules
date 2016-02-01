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

use phpOMS\Account\Account;
use phpOMS\Account\NullAccount;
use phpOMS\Datatypes\Location;

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
class Event
{

    /**
     * Calendar ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = null;

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

    /**
     * People.
     *
     * @var array
     * @since 1.0.0
     */
    private $location = null;

    private $calendar = 0;

    /**
     * People.
     *
     * @var array
     * @since 1.0.0
     */
    private $people = [];

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->location  = new Location();
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getPeople() : array
    {
        return $this->people;
    }

    public function getPerson(int $id) : Account
    {
        return $this->people[$id] ?? new NullAccount();
    }

    public function addPerson(Account $person)
    {
        $this->people[] = $person;

        end($this->people);
        $key = key($this->people);
        reset($this->people);

        return $key;
    }

    /**
     * Remove Element from list.
     *
     * @param int $id Task element
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removePerson(int $id) : bool
    {
        if (isset($this->people[$id])) {
            unset($this->people[$id]);

            return true;
        }

        return false;
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

    public function setLocation(Location $location)
    {
        $this->location = $location;
    }

    public function getLocation() : Location
    {
        return $this->location;
    }

    public function getCalendar() : int
    {
        return $this->calendar;
    }

    public function setCalendar(int $calendar)
    {
        $this->calendar = $calendar;
    }
}
