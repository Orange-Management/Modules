<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\CostCenterAccounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\CostCenterAccounting\Models;

/**
 * Cost center class.
 *
 * @package Modules\CostCenterAccounting\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class CostCenter
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Code.
     *
     * @var string
     * @since 1.0.0
     */
    private string $code = '';

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
     * Parent.
     *
     * @var null|int|CostCenter
     * @since 1.0.0
     */
    private $parent = null;

    /**
     * Get balance id
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
     * Set code
     *
     * @param string $code Balance code
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCode(string $code) : void
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getCode() : string
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name Balance name
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
     * Set description
     *
     * @param string $description Balance description
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
     * Set parent
     *
     * @param string $parent Parent
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setParent($parent) : void
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getParent()
    {
        return $this->parent;
    }
}
