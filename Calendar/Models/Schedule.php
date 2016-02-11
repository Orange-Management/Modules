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

use phpOMS\Datatypes\Exception\InvalidEnumValue;

/**
 * Schedule class.
 *
 * @category   Calendar
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Schedule
{
    private $id = 0;

    private $uid = '';

    private $status = ScheduleStatus::ACTIVE;

    private $freqType = FrequencyType::ONCE;

    private $freqInterval = FrequencyInterval::DAY;

    private $relativeInternal = FrequencyRelative::FIRST;

    private $intervalType = IntervalType::ABSOLUTE;

    private $recurrenceFactor = 0;

    private $start = null;

    private $duration = 3600;

    private $end = null;

    private $createdAt = null;

    private $createdBy = 0;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->start     = new \DateTime('now');
        $this->end       = new \DateTime('now');
        $this->end->setTimestamp($this->end->getTimestamp() + $this->duration);
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getStatus() : int
    {
        return $this->status;
    }

    public function setStatus(int $status)
    {
        if (!ScheduleStatus::isValidValue($status)) {
            throw new InvalidEnumValue($status);
        }

        $this->status = $status;

        return $this;
    }

    public function getFreqType() : int
    {
        return $this->freqType;
    }

    public function setFreqType(int $freqType)
    {
        if (!FrequencyType::isValidValue($freqType)) {
            throw new InvalidEnumValue($freqType);
        }

        $this->freqType = $freqType;

        return $this;
    }

    public function getIntervalType() : int
    {
        return $this->intervalType;
    }

    public function setIntervalType(int $intervalType)
    {
        if (!IntervalType::isValidValue($intervalType)) {
            throw new InvalidEnumValue($intervalType);
        }

        $this->intervalType = $intervalType;

        return $this;
    }

    public function getFrequencyRelative() : int
    {
        return $this->relativeInternal;
    }

    public function setFrequencyRelative(int $relativeInternal)
    {
        if (!FrequencyRelative::isValidValue($relativeInternal)) {
            throw new InvalidEnumValue($relativeInternal);
        }

        $this->relativeInternal = $relativeInternal;

        return $this;
    }

    public function setFreqInterval(int $freqInterval)
    {
        if (!FrequencyInterval::isValidValue($freqInterval)) {
            throw new InvalidEnumValue($freqInterval);
        }

        $this->freqInterval = $freqInterval;

        return $this;
    }

    public function getFreqInterval() : int
    {
        return $this->freqInterval;
    }

    public function getRecurrenceFactor() : int
    {
        return $this->recurrenceFactor;
    }

    public function setRecurrenceFactor(int $recurrence)
    {
        $this->recurrenceFactor = $recurrence;

        return $this;
    }

    public function getStart() : \DateTime
    {
        return $this->start;
    }

    public function setStart(\DateTime $start)
    {
        $this->start = $start;

        return $this;
    }

    public function getDuration() : int
    {
        return $this->duration;
    }

    public function setDuration(int $duration)
    {
        if($duration < 1) {
            throw new \InvalidArgumentException($duration);
        }

        $this->duration = $duration;

        return $this;
    }

    public function getEnd() : \DateTime
    {
        return $this->end;
    }

    public function setEnd(\DateTime $end)
    {
        $this->end = $end;

        return $this;
    }

    public function setCreatedBy(int $creator)
    {
        $this->createdBy = $creator;

        return $this;
    }

    public function getCreatedBy() : int
    {
        return $this->createdBy;
    }
}
