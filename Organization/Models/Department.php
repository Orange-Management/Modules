<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Organization\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Organization\Models;

use phpOMS\Contract\ArrayableInterface;

/**
 * Organization department class.
 *
 * @package Modules\Organization\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Department implements ArrayableInterface, \JsonSerializable
{
    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $name = '';

    /**
     * Parent
     *
     * @var mixed
     * @since 1.0.0
     */
    protected ?self $parent = null;

    /**
     * Status
     *
     * @var int
     * @since 1.0.0
     */
    protected int $status = Status::INACTIVE;

    /**
     * Unit this department belongs to
     *
     * @var Unit
     * @since 1.0.0
     */
    protected Unit $unit;

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $description = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $descriptionRaw = '';

    /**
     * Constructor
     *
     * @param string $name Department name
     *
     * @since 1.0.0
     */
    public function __construct(string $name = '')
    {
        $this->setName($name);
    }

    /**
     * Get id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name Name
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Get parent
     *
     * @return Department
     *
     * @since 1.0.0
     */
    public function getParent() : self
    {
        return $this->parent ?? new NullDepartment();
    }

    /**
     * Set parent
     *
     * @param null|self $parent Parent
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setParent(?self $parent) : void
    {
        $this->parent = $parent;
    }

    /**
     * Get status
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
     * Set status
     *
     * @param int $status Status
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
     * Get unit
     *
     * @return Unit
     *
     * @since 1.0.0
     */
    public function getUnit() : Unit
    {
        return $this->unit ?? new NullUnit();
    }

    /**
     * Set unit
     *
     * @param Unit $unit Unit
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setUnit(Unit $unit) : void
    {
        $this->unit = $unit;
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $desc Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription(string $desc) : void
    {
        $this->description = $desc;
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * Set description
     *
     * @param string $desc Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescriptionRaw(string $desc) : void
    {
        $this->descriptionRaw = $desc;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'unit'        => $this->unit ?? new NullUnit(),
        ];
    }

    /**
     * Get string representation.
     *
     * @return string
     *
     * @since 1.0.0
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
