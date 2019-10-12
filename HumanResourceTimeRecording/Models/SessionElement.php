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
     * Session element type.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $type = ClockingStatus::START;

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
     * @var   int
     * @since 1.0.0
     */
    private int $session = 0;

    /**
     * Constructor.
     *
     * @param int            $session Session id
     * @param null|\DateTiem $dt      DateTime of the session element
     *
     * @since 1.0.0
     */
    public function __construct(int $session = 0, \DateTime $dt = null)
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
     * Get the session element type
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Set the session element type
     *
     * @param int $type Session element type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setType(int $type) : void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'       => $this->id,
            'type'     => $this->type,
            'dt'       => $this->dt->format('Y-m-d H:i:s'),
            'sesseion' => $this->session,
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
