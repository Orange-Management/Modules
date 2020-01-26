<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\ItemManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ItemManagement\Models;

/**
 * Account class.
 *
 * @package Modules\ItemManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Item
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    private $number = '';

    private $articleGroup = 0;

    private $salesGroup = 0;

    private $productGroup = 0;

    private $segment = 0;

    private $successor = 0;

    private int $type = 0;

    private $media = [];

    private $l11n = null;

    private $attributes = [];

    private $partslist = null;

    private $purchase = [];

    private $disposal = null;

    private $createdAt = null;

    private $info = '';

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
     * Set the successor item
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setSuccessor(int $successor): void
    {
        $this->successor = $successor;
    }

    /**
     * Get the successor item
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getSuccessor(): int
    {
        return $this->successor;
    }

    /**
     * Get the item number
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getNumber() : string
    {
        return $this->number;
    }


    /**
     * Set the item number
     *
     * @param string $number Number
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setNumber(string $number) : void
    {
        $this->number = $number;
    }
}
