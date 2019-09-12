<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Organization
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Organization\Models;

use phpOMS\Contract\ArrayableInterface;

/**
 * Organization position class.
 *
 * @package Modules\Organization
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Position implements ArrayableInterface, \JsonSerializable
{
    /**
     * Article ID.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Name.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Parent
     *
     * @var   mixed
     * @since 1.0.0
     */
    private $parent = null;

    /**
     * Department
     *
     * @var   mixed
     * @since 1.0.0
     */
    private $department = null;

    /**
     * Description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $descriptionRaw = '';

    /**
     * Status
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $status = Status::INACTIVE;

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
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getParent()
    {
        return $this->parent ?? new NullPosition();
    }

    /**
     * Set parent
     *
     * @param mixed $parent Parent
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setParent($parent) : void
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getDepartment()
    {
        return $this->department ?? new NullDepartment();
    }

    /**
     * Set department
     *
     * @param mixed $department Department
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDepartment($department) : void
    {
        $this->department = $department;
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
            'department' => $this->department,
            'parent' => $this->parent,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
