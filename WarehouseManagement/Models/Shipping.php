<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Warehousing\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\WarehouseManagement\Models;

/**
 * Warehouse class.
 *
 * @package Modules\Warehousing\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Shipping
{

    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Order.
     *
     * @var   intstring
     * @since 1.0.0
     */
    private $order = '';

    /**
     * From.
     *
     * @var   \phpOMS\Stdlib\Base\Address
     * @since 1.0.0
     */
    private $to = null;

    /**
     * Warehouse.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $warehouse = '';

    /**
     * Date of arrival.
     *
     * @var   null|\DateTime
     * @since 1.0.0
     */
    private ?\DateTime $delivered = null;

    /**
     * Person who sent the delivery.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $sender = null;

    /**
     * Warehouse.
     *
     * @var   \Modules\Warehousing\Models\ArrivalStatus
     * @since 1.0.0
     */
    private $status = null;

    /**
     * Shipping.
     *
     * @var   \Modules\Warehousing\Models\Article[]
     * @since 1.0.0
     */
    private static array $instances = [];

    /**
     * Constructor.
     *
     * @param int $id Article ID
     *
     * @since 1.0.0
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Initializing object.
     *
     * @param int $id Article ID
     *
     * @return \Modules\Warehousing\Models\Article
     *
     * @since 1.0.0
     */
    public static function getInstance($id)
    {
        if (!isset(self::$instances[$id])) {
            self::$instances[$id] = new self($id);
        }

        return self::$instances[$id];
    }


    public function init($id) : void
    {
    }


    public function __clone()
    {
    }

    /**
     * Get ID.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get order.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set order.
     *
     * @param int $order Order ID
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setOrder($order) : void
    {
        $this->order = $order;
    }

    /**
     * Get delivered.
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Set delivered.
     *
     * @param \DateTime $delivered Date of delivery
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDelivered($delivered) : void
    {
        $this->delivered = $delivered;
    }

    /**
     * Get To.
     *
     * @return \phpOMS\Stdlib\Base\Address
     *
     * @since 1.0.0
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set To.
     *
     * @param \phpOMS\Stdlib\Base\Address $to Receiver
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTo($to) : void
    {
        $this->to = $to;
    }

    /**
     * Get status.
     *
     * @return \Modules\Warehousing\Models\ArrivalStatus
     *
     * @since 1.0.0
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status.
     *
     * @param  \Modules\Warehousing\Models\ArrivalStatus
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setStatus($status) : void
    {
        $this->status = $status;
    }

    /**
     * Get warehouse.
     *
     * @return \Modules\Warehousing\Models\Warehouse
     *
     * @since 1.0.0
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

    /**
     * Get acceptor.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set sender.
     *
     * @param int $sender Person who accepted the consignment
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setSender($sender) : void
    {
        $this->sender = $sender;
    }


    public function delete() : void
    {
    }


    public function create() : void
    {
    }


    public function update() : void
    {
    }


    public function serialize() : void
    {
    }


    public function unserialize($data) : void
    {
    }
}
