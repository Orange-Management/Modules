<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\Module\ModuleStatus;

/**
 * Module class.
 *
 * @package Modules\Admin\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Module
{

    /**
     * Account id.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Account name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected string $name = '';

    /**
     * Account name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected string $description = '';

    /**
     * Group status.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $status = ModuleStatus::INACTIVE;

    /**
     * Created at.
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    protected \DateTime $createdAt;

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
     * Get module id.
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
     * Get created at.
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt ?? new \DateTime('NOW');
    }

    /**
     * Get module name.
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
     * Set module name.
     *
     * @param string $name module name
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
     * Get module description.
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
     * Set module description.
     *
     * @param string $description Module description
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
     * Get module status.
     *
     * @return int Module status
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * Set module status.
     *
     * @param int $status Module status
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setStatus(int $status) : void
    {
        // todo: check valid
        $this->status = $status;
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
     * Json serialize.
     *
     * @return array<string, int|string>
     *
     * @since 1.0.0
     */
    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * To array
     *
     * @return array<string, int|string>
     *
     * @since 1.0.0
     */
    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'createdAt'   => $this->createdAt->format('Y-m-d H:i:s'),
        ];
    }
}
