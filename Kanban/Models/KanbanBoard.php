<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Kanban\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Kanban\Models;

/**
 * Task class.
 *
 * @package Modules\Kanban\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class KanbanBoard implements \JsonSerializable
{
    /**
     * ID.
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
    private string $name = '';

    private int $status = BoardStatus::ACTIVE;

    private $order = 0;
    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    private $createdBy = 0;

    private $createdAt = null;

    private $columns = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * Get id.
     *
     * @return int Model id
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
     * Get the status
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
     * Set the status
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
     * Get the order
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getOrder() : int
    {
        return $this->order;
    }

    /**
     * Set the order
     *
     * @param int $order Order
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setOrder(int $order) : void
    {
        $this->order = $order;
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
     * @param string $description Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * Get created by
     *
     * @return int|\phpOMS\Account\Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param mixed $id Created by
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy($id) : void
    {
        $this->createdBy = $id;
    }

    /**
     * Get created at date time
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Get the columns
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getColumns() : array
    {
        return $this->columns;
    }

    /**
     * Add a column
     *
     * @param mixed $column Column
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addColumn($column) : void
    {
        $this->columns[] = $column;
    }

    /**
     * Remove a column
     *
     * @param int $id Id to remove
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeColumn(int $id) : bool
    {
        if (isset($this->columns[$id])) {
            unset($this->columns[$id]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : array
    {
        return [];
    }
}
