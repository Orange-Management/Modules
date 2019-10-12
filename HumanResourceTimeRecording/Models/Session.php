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
 * Session model
 *
 * @package Modules\HumanResourceTimeRecording\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Session implements ArrayableInterface, \JsonSerializable
{
    /**
     * Session ID.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Session start
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    private \DateTime $start;

    /**
     * Session end
     *
     * @var   null|\DateTime
     * @since 1.0.0
     */
    private ?\DateTime $end = null;

    /**
     * Busy time.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $busy = 0;

    /**
     * Session type.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $type = ClockingType::OFFICE;

    /**
     * Session elements.
     *
     * @var   array
     * @since 1.0.0
     */
    private array $sessionElements = [];

    /**
     * Employee.
     *
     * @var   int|Employee
     * @since 1.0.0
     */
    private $employee = 0;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->start = new \DateTime('now');
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
     * Add a session element to the session
     *
     * @param int|SessionElement $element Session element
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addSessionElement($element) : void
    {
        $this->sessionElement[] = $element;

        // todo: if quit element or pause element re-calculate busy time!
    }

    /**
     * Get busy time
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getBusy() : int
    {
        return $this->busy;
    }

    /**
     * Get the session type
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
     * Set the session type
     *
     * @param int $type Session type
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
     * Return session start
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getStart() : \DateTime
    {
        return $this->start;
    }

    /**
     * Return session end
     *
     * @return null|\DateTime
     *
     * @since 1.0.0
     */
    public function getEnd() : ?\DateTime
    {
        return $this->end;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'       => $this->id,
            'start'    => $this->start->format('Y-m-d H:i:s'),
            'end'      => $this->end === null ? null : $this->end->format('Y-m-d H:i:s'),
            'busy'     => $this->busy,
            'type'     => $this->type,
            'employee' => $this->employee,
            'elements' => $this->sessionElements,
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
