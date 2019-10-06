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
class Arrival
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
     * @var   int
     * @since 1.0.0
     */
    private int $order = '';

    /**
     * From.
     *
     * @var   \phpOMS\Stdlib\Base\Address
     * @since 1.0.0
     */
    private $from = null;

    /**
     * Warehouse.
     *
     * @var   \Modules\Warehousing\Models\Warehouse
     * @since 1.0.0
     */
    private $warehouse = null;

    /**
     * Date of arrival.
     *
     * @var   null|\DateTime
     * @since 1.0.0
     */
    private ?\DateTime $date = null;

    /**
     * Person who accepted the delivery.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $acceptor = null;

    /**
     * Warehouse.
     *
     * @var   \Modules\Warehousing\Models\ArrivalStatus
     * @since 1.0.0
     */
    private int $status = null;

    /* TODO: count, packaging, product count etc.... for every single position + where do you put it */

    /**
     * Arrival.
     *
     * @var   \Modules\Warehousing\Models\Arrival[]
     * @since 1.0.0
     */
    private static array $instances = [];

    /**
     * Constructor.
     *
     * @param int $id Arrival ID
     *
     * @since 1.0.0
     */
    private function __construct($id)
    {
        $this->id = $id;
    }

    public function init($id) : void
    {
    }

    public function __clone()
    {
    }

    /**
     * Initializing object.
     *
     * @param int $id Arrival ID
     *
     * @return \Modules\Warehousing\Models\Arrival
     *
     * @since 1.0.0
     */
    public function getInstance($id)
    {
        if (!isset(self::$instances[$id])) {
            self::$instances[$id] = new self($id);
        }

        return self::$instances[$id];
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
     * Get date of when the consignment arrived.
     *
     * @return \DateTime Date of arrival
     *
     * @since 1.0.0
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date of when the consignment arrived.
     *
     * @param \DateTime $date Date of arrival
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDate($date) : void
    {
        $this->date = $date;
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
     * @param int $order Order Id
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
     * Get From.
     *
     * @return \phpOMS\Stdlib\Base\Address
     *
     * @since 1.0.0
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set From.
     *
     * @param \phpOMS\Stdlib\Base\Address $from Consignor
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setFrom($from) : void
    {
        $this->from = $from;
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
    public function getAcceptor()
    {
        return $this->acceptor;
    }

    /**
     * Set acceptor.
     *
     * @param int $acceptor Person who accepted the consignment
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setAcceptor($acceptor) : void
    {
        $this->acceptor = $acceptor;
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
