<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Billing\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Billing\Models;

use phpOMS\Localization\Money;

/**
 * Invoice class.
 *
 * @package Modules\Billing\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class InvoiceElement implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    private $order = 0;

    private $item = 0;

    private $itemName = '';

    private $itemDescription = '';

    private $quantity = 0;

    private $singlePrice = null;

    private $totalPrice = null;

    private $singleDiscountP = null;

    private $totalDiscountP = null;

    private $singleDiscountR = 0;

    private $discountQ = 0;

    private $singlePriceNet = null;

    private $totalPriceNet = null;

    private $taxP = null;

    private $taxR = 0.0;

    private $singlePriceGross = null;

    private $totalPriceGross = null;

    private $event = 0;

    private $promotion = 0;

    private $invoice = 0;

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
     * Set event.
     *
     * @param int $event Event
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setEvent(int $event) : void
    {
        $this->event = $event;
    }

    /**
     * Get event.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set promotion.
     *
     * @param int $promotion Promotion
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setPromotion(int $promotion) : void
    {
        $this->promotion = $promotion;
    }

    /**
     * Get promotion.
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set order.
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
     * Get order.
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
     * Set item.
     *
     * @param mixed $item Item
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setItem($item) : void
    {
        $this->item = $item;
    }

    /**
     * Set item name.
     *
     * @param string $name Name
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setItemName(string $name) : void
    {
        $this->itemName = $name;
    }

    /**
     * Get item name.
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getItemName() : string
    {
        return $this->itemName;
    }

    /**
     * Set item description.
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setItemDescription(string $description) : void
    {
        $this->itemDescription = $description;
    }

    /**
     * Get item description.
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getItemDescripion() : string
    {
        return $this->itemDescription;
    }

    /**
     * Set quantity.
     *
     * @param int|float $quantity Quantity
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setQuantity($quantity) : void
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity.
     *
     * @return int|float
     *
     * @since 1.0.0
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set single unit price.
     *
     * @param Money $price Single unit price
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setSinglePrice(Money $price) : void
    {
        $this->singlePrice = $price;
    }

    /**
     * Get single unit price.
     *
     * @return null|Money
     *
     * @since 1.0.0
     */
    public function getSinglePrice() : ?Money
    {
        return $this->singlePrice;
    }

    /**
     * Set total price.
     *
     * @param Money $price Total price
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTotalPrice(Money $price) : void
    {
        $this->totalPrice = $price;
    }

    /**
     * Get total price.
     *
     * @return null|Money
     *
     * @since 1.0.0
     */
    public function getTotalPrice() : ?Money
    {
        return $this->totalPrice;
    }

    /**
     * Set discount price.
     *
     * @param Money $discount Discount
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDiscountPrice(Money $discount) : void
    {
        $this->singleDiscountP = $discount;
    }

    /**
     * Get discount price.
     *
     * @return null|Money
     *
     * @since 1.0.0
     */
    public function getDiscountPrice() : ?Money
    {
        return $this->singleDiscountP;
    }

    /**
     * Set total discount price.
     *
     * @param Money $discount Discount price
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTotalDiscountPrice(Money $discount) : void
    {
        $this->totalDiscountP = $discount;
    }

    /**
     * Get total discount price.
     *
     * @return null|Money
     *
     * @since 1.0.0
     */
    public function getTotalDiscountPrice() : ?Money
    {
        return $this->totalDiscountP;
    }

    /**
     * Set discount percentage.
     *
     * @param float $discount Discount percentag
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDiscountPercentage(float $discount) : void
    {
        $this->singleDiscountR = $discount;
    }

    /**
     * Get discount percentage.
     *
     * @return float
     *
     * @since 1.0.0
     */
    public function getDiscountPercentage() : float
    {
        return $this->singleDiscountR;
    }

    /**
     * Set discount quantity.
     *
     * @param int|float $quantity Quantity
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDiscountQuantity($quantity) : void
    {
        $this->discountQ = $quantity;
    }

    /**
     * Get discount quantity.
     *
     * @return int|float
     *
     * @since 1.0.0
     */
    public function getDiscountQuantity()
    {
        return $this->discountQ;
    }

    /**
     * Set single net price.
     *
     * @param Money $price Net price
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setSingleNetPrice(Money $price) : void
    {
        $this->singlePriceNet = $price;
    }

    /**
     * Get single net price.
     *
     * @return null|Money
     *
     * @since 1.0.0
     */
    public function getSingleNetPrice() : ?Money
    {
        return $this->singlePriceNet;
    }

    /**
     * Set total net price.
     *
     * @param Money $price Total net price
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTotalNetPrice(Money $price) : void
    {
        $this->totalPriceNet = $price;
    }

    /**
     * Get total net price.
     *
     * @return null|Money
     *
     * @since 1.0.0
     */
    public function getTotalNetPrice() : ?Money
    {
        return $this->totalPriceNet;
    }

    /**
     * Set tax price.
     *
     * @param Money $tax Tax price
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTaxPrice(Money $tax) : void
    {
        $this->taxP = $tax;
    }

    /**
     * Get tax price.
     *
     * @return null|Money
     *
     * @since 1.0.0
     */
    public function getTaxPrice() : ?Money
    {
        return $this->taxP;
    }

    /**
     * Set tax rate.
     *
     * @param float $tax Tax rate
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTaxPercentage(float $tax) : void
    {
        $this->taxR = $tax;
    }

    /**
     * Get tax rate.
     *
     * @return float
     *
     * @since 1.0.0
     */
    public function getTaxPercentage() : float
    {
        return $this->taxR;
    }

    /**
     * Set single gross price.
     *
     * @param Money $price Single gross price
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setSingleGrossPrice(Money $price) : void
    {
        $this->singlePriceGross = $price;
    }

    /**
     * Get single gross price.
     *
     * @return null|Money
     *
     * @since 1.0.0
     */
    public function getSingleGrossPrice() : ?Money
    {
        return $this->singlePriceGross;
    }

    /**
     * Set total gross price.
     *
     * @param Money $price Total gross price
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTotalGrossPrice(Money $price) : void
    {
        $this->totalPriceGross = $price;
    }

    /**
     * Get total gross price.
     *
     * @return null|Money
     *
     * @since 1.0.0
     */
    public function getTotalGrossPrice() : ?Money
    {
        return $this->totalPriceGross;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [];
    }
}
