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
     * @var   string
     * @since 1.0.0
     */
    private string $order = '';

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
     * @var   Warehouse
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
    private ?int $acceptor = null;

    /**
     * Warehouse.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $status = 0;

    /* TODO: count, packaging, product count etc.... for every single position + where do you put it */

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
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * Set status.
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
     * Get warehouse.
     *
     * @return Warehouse
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
}
