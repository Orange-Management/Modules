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
 * Article class.
 *
 * @package Modules\Warehousing\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Article
{
    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Matchcode.
     *
     * @var string
     * @since 1.0.0
     */
    private string $matchcode = '';

    /**
     * Sector.
     *
     * @var null|string
     * @since 1.0.0
     */
    private ?string $sector = null;

    /**
     * Group.
     *
     * @var null|string
     * @since 1.0.0
     */
    private ?string $group = null;

    /**
     * Suppliers.
     *
     * supplier price leadtime
     *
     * @var null|string
     * @since 1.0.0
     */
    private ?string $suppliers = null;

    /**
     * Localization strings.
     *
     * [en] Name - Description
     *
     * @var array
     * @since 1.0.0
     */
    private array $invoice_i18n = [];

    /**
     * Prizes.
     *
     * [id] name country state prize discount% discountA bonus-in-kind groupA groupB amount event
     *
     * @var array
     * @since 1.0.0
     */
    private array $prizes = [];

    /**
     * Active supplier.
     *
     * @var null|string
     * @since 1.0.0
     */
    private ?string $pprice = null;

    /**
     * Created.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    private ?\DateTime $created = null;

    /**
     * Creator.
     *
     * @var null|\phpOMS\Models\User
     * @since 1.0.0
     */
    private $creator = null;

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
     * Get name.
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name Name of the article
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setName($name) : void
    {
        $this->name = $name;
    }

    /**
     * Get matchcode.
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getMatchcode()
    {
        return $this->matchcode;
    }

    /**
     * Set matchcode.
     *
     * @param string $matchcode Matchcode of the article
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setMatchcode($matchcode) : void
    {
        $this->matchcode = $matchcode;
    }

    /**
     * Get description.
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param string $desc Description of the article
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription($desc) : void
    {
        $this->description = $desc;
    }

    /**
     * Get created.
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created.
     *
     * @param \DateTime $created Date of when the article got created
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreated($created) : void
    {
        $this->created = $created;
    }

    /**
     * Get creator.
     *
     * @return \phpOMS\Models\User
     *
     * @since 1.0.0
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set creator.
     *
     * @param \phpOMS\Models\User $creator Creator ID
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreator($creator) : void
    {
        $this->creator = $creator;
    }

    /**
     * Add price to pricelist.
     *
     * @param array $price Price
     * @param bool  $db    Update DB and cache?
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addPrice($price, $db = true) : void
    {
        $id                = 0; /* insert and get id */
        $this->prices[$id] = $price;
    }

    /**
     * Remove price from pricelist.
     *
     * @param int  $id Price ID
     * @param bool $db Update DB and cache?
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function removePrice($id, $db = true) : void
    {
        if (isset($this->prices[$id])) {
            unset($this->prices[$id]);
        }
    }

    /**
     * Add price to pricelist.
     *
     * @param int   $id    Price ID
     * @param array $price Price
     * @param bool  $db    Update DB and cache?
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function editPrice($id, $price, $db = true) : void
    {
        if (isset($this->prices[$id])) {
            $this->prices[$id] = $price;
        }
    }
}
