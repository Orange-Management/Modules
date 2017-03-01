<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Sales\Models;

/**
 * Sales invoice class.
 *
 * @category   Modules
 * @package    Modules\Sales
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Invoice
{

    /**
     * Database instance.
     *
     * @var \phpOMS\DataStorage\Database\Database
     * @since 1.0.0
     */
    private $dbPool = null;

    /**
     * private $id = null;.
     *
     * private $referer = null;
     *
     * private $reference = null;
     *
     * private $orderer = null;
     *
     * private $ordered = null;
     *
     * private $creator = null;
     *
     * private $created = null;
     *
     * private $client = null;
     *
     * private $deliveryAddress = null;
     *
     * private $billingAddress = null;
     *
     * private $payment = null;
     *
     * private $delivery = null;
     *
     * private $freightage = null;
     *
     * private $invoiceItemList = [];
     *
     * private $info = '';
     *
     * private $status = null;
     *
     * private $price = null;
     *
     * private $currency = null;
     *
     * /**
     * Constructor
     *
     * @param \phpOMS\DataStorage\Database\DatabasePool $dbPool Database pool instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbPool)
    {
        $this->dbPool = $dbPool;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param null $reference
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOrderer()
    {
        return $this->orderer;
    }

    /**
     * @param null $orderer
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setOrderer($orderer)
    {
        $this->orderer = $orderer;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOrdered()
    {
        return $this->ordered;
    }

    /**
     * @param null $ordered
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setOrdered($ordered)
    {
        $this->ordered = $ordered;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param null $creator
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param null $created
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param null $client
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param null $deliveryAddress
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param null $billingAddress
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param null $payment
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param null $delivery
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFreightage()
    {
        return $this->freightage;
    }

    /**
     * @param null $freightage
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFreightage($freightage)
    {
        $this->freightage = $freightage;
    }

    /**
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getInvoiceItemList()
    {
        return $this->invoiceItemList;
    }

    /**
     * @param array $invoiceItemList
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setInvoiceItemList($invoiceItemList)
    {
        $this->invoiceItemList = $invoiceItemList;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }

    /**
     * {@inheritdoc}
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * {@inheritdoc}
     */
    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * {@inheritdoc}
     */
    public function init($id)
    {
        // TODO: Implement init() method.
    }

    public function getPrice()
    {
    }

    public function getDiscount()
    {
    }

    public function getDiscountP()
    {
    }

    public function getProfit()
    {
    }

    public function getGrossProfit()
    {
    }

    public function getPayed()
    {
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
