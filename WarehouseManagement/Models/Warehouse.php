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
class Warehouse
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

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Location of the warehouse.
     *
     * @var \phpOMS\Stdlib\Base\Location
     * @since 1.0.0
     */
    private $location = null;

    /**
     * Constructor.
     *
     * @param int $id Warehouse ID
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
     * Get name.
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
     * Set name.
     *
     * @param string $description Description of the warehouse
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription($description) : void
    {
        $this->description = $description;
    }

    /**
     * Get location.
     *
     * @return \phpOMS\Stdlib\Base\Location
     *
     * @since 1.0.0
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set location.
     *
     * @param \phpOMS\Stdlib\Base\Location $location Location of the warehouse
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setLocation($location) : void
    {
        $this->location = $location;
    }
}
