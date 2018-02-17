<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    Modules\Organization
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Organization\Models;

use phpOMS\Contract\ArrayableInterface;

/**
 * Organization position class.
 *
 * @package    Modules\Organization
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Position implements ArrayableInterface, \JsonSerializable
{
    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Parent
     *
     * @var mixed
     * @since 1.0.0
     */
    private $parent = null;

    /**
     * Department
     *
     * @var mixed
     * @since 1.0.0
     */
    private $department = null;

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private $description = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private $descriptionRaw = '';

    /**
     * Status
     *
     * @var int
     * @since 1.0.0
     */
    protected $status = Status::INACTIVE;

    /**
     * Get id
     * 
     * @return int
     *
     * @since  1.0.0
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
     * @since  1.0.0
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
     * @since  1.0.0
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get parent
     * 
     * @return mixed
     *
     * @since  1.0.0
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
     * @return mixed
     *
     * @since  1.0.0
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     * 
     * @return mixed
     *
     * @since  1.0.0
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
     * @return mixed
     *
     * @since  1.0.0
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

    /**
     * Get status
     * 
     * @return int
     *
     * @since  1.0.0
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
     * @since  1.0.0
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * Get description
     * 
     * @return string
     *
     * @since  1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set description
     * 
     * @param int $desc Description
     * 
     * @return void
     *
     * @since  1.0.0
     */
    public function setDescription(string $desc)
    {
        $this->description = $desc;
    }

    /**
     * Get description
     * 
     * @return string
     *
     * @since  1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * Set description
     * 
     * @param int $desc Description
     * 
     * @return void
     *
     * @since  1.0.0
     */
    public function setDescriptionRaw(string $desc)
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
     * Get string representation.
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function __toString()
    {
        return json_encode($this->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
