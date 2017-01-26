<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
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

use phpOMS\Datatypes\Exception\InvalidEnumValue;

/**
 * Schedule class.
 *
 * @category   Calendar
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Schedule
{
    /**
     * Schedule ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Calendar uid.
     *
     * @var string
     * @since 1.0.0
     */
    private $uid = '';

    /**
     * Schedule status.
     *
     * @var int
     * @since 1.0.0
     */
    private $status = ScheduleStatus::ACTIVE;

    /**
     * Frequency type.
     *
     * @var int
     * @since 1.0.0
     */
    private $freqType = FrequencyType::ONCE;

    /**
     * Frequency interval.
     *
     * @var int
     * @since 1.0.0
     */
    private $freqInterval = FrequencyInterval::DAY;

    /**
     * Frequency relative.
     *
     * @var int
     * @since 1.0.0
     */
    private $relativeInternal = FrequencyRelative::FIRST;

    /**
     * Interval type.
     *
     * @var int
     * @since 1.0.0
     */
    private $intervalType = IntervalType::ABSOLUTE;

    /**
     * Recurrence factor.
     *
     * @var int
     * @since 1.0.0
     */
    private $recurrenceFactor = 0;

    /**
     * Start.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $start = null;

    /**
     * Duration.
     *
     * @var int
     * @since 1.0.0
     */
    private $duration = 3600;

    /**
     * End.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $end = null;

    /**
     * Created at.
     *
     * @var \DateTime
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
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->start     = new \DateTime('now');
        $this->end       = new \DateTime('now');
        $this->end->setTimestamp($this->end->getTimestamp() + $this->duration);
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
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @param int $status Schedule status
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setStatus(int $status)
    {
        if (!ScheduleStatus::isValidValue($status)) {
            throw new InvalidEnumValue($status);
        }

        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFreqType() : int
    {
        return $this->freqType;
    }

    /**
     * @param int $freqType Frequency type
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFreqType(int $freqType)
    {
        if (!FrequencyType::isValidValue($freqType)) {
            throw new InvalidEnumValue($freqType);
        }

        $this->freqType = $freqType;

        return $this;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getIntervalType() : int
    {
        return $this->intervalType;
    }

    /**
     * @param int $intervalType Interval type
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setIntervalType(int $intervalType)
    {
        if (!IntervalType::isValidValue($intervalType)) {
            throw new InvalidEnumValue($intervalType);
        }

        $this->intervalType = $intervalType;

        return $this;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFrequencyRelative() : int
    {
        return $this->relativeInternal;
    }

    /**
     * @param int $relativeInterval Relative interval
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFrequencyRelative(int $relativeInterval)
    {
        if (!FrequencyRelative::isValidValue($relativeInterval)) {
            throw new InvalidEnumValue($relativeInterval);
        }

        $this->relativeInternal = $relativeInterval;

        return $this;
    }

    /**
     * @param int $freqInterval Frequency interval
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFreqInterval(int $freqInterval)
    {
        if (!FrequencyInterval::isValidValue($freqInterval)) {
            throw new InvalidEnumValue($freqInterval);
        }

        $this->freqInterval = $freqInterval;

        return $this;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFreqInterval() : int
    {
        return $this->freqInterval;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRecurrenceFactor() : int
    {
        return $this->recurrenceFactor;
    }

    /**
     * @param int $recurrence Recurrence
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setRecurrenceFactor(int $recurrence)
    {
        $this->recurrenceFactor = $recurrence;

        return $this;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStart() : \DateTime
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start Schedule start
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDuration() : int
    {
        return $this->duration;
    }

    /**
     * @param int $duration Duration
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDuration(int $duration)
    {
        if ($duration < 1) {
            throw new \InvalidArgumentException($duration);
        }

        $this->duration = $duration;

        return $this;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getEnd() : \DateTime
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end Schedule end
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setEnd(\DateTime $end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @param int $creator Creator
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreatedBy(int $creator)
    {
        $this->createdBy = $creator;

        return $this;
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
}
