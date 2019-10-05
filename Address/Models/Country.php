<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\News\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Address\Models;

/**
 * Country model
 *
 * @package Modules\Address\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Country
{
    /**
     * Country id.
     *
     * @var   int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Country name.
     *
     * @var   string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Country name.
     *
     * @var   string
     * @since 1.0.0
     */
    private $native = '';

    /**
     * Country code.
     *
     * @var   string
     * @since 1.0.0
     */
    private $code2 = '';

    /**
     * Country code.
     *
     * @var   string
     * @since 1.0.0
     */
    private $code3 = '';

    /**
     * Country code.
     *
     * @var   int
     * @since 1.0.0
     */
    private $codenum = 0;

    /**
     * Get id
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
     * Get country name
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
     * Get country name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getNative() : string
    {
        return $this->name;
    }

    /**
     * Get country code
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getCode2() : string
    {
        return $this->code2;
    }

    /**
     * Get country code
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getCode3() : string
    {
        return $this->code3;
    }

    /**
     * Get country numeric
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getNumeric() : int
    {
        return $this->codenum;
    }
}
