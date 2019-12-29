<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\HumanResourceTimeRecording\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\HumanResourceTimeRecording\Models;

use phpOMS\Contract\ArrayableInterface;

/**
 * Session element model
 *
 * @package Modules\HumanResourceTimeRecording\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class SessionElement implements ArrayableInterface, \JsonSerializable
{
    /**
     * Session element ID.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Session element status.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $status = ClockingStatus::START;

    /**
     * DateTime
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    private \DateTime $dt;

    /**
     * Session id this element belongs to
     *
     * @var   int|Session
     * @since 1.0.0
     */
    private $session = 0;

    /**
     * Constructor.
     *
     * @param int            $session Session id
     * @param null|\DateTiem $dt      DateTime of the session element
     *
     * @since 1.0.0
     */
    public function __construct($session = 0, \DateTime $dt = null)
    {
        $this->session = $session;
        $this->dt      = $dt ?? new \DateTime('now');
    }

    /**
     * Get id.
     *
     * @return int Account id
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the dt data
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getDatetime() : \DateTime
    {
        return $this->dt;
    }

    /**
     * Get the session element status
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * Set the session element status
     *
     * @param int $status Session element status
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    /**
     * Get session this element is for
     *
     * @return int|Session
     *
     * @since 1.0.0
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'       => $this->id,
            'status'   => $this->status,
            'dt'       => $this->dt,
            'session'  => \is_int($this->session) ? $this->session : $this->session->getId(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) \json_encode($this->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
