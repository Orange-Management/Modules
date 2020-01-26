<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class RiskObject
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    private $title = '';
    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';
    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $descriptionRaw = '';

    private $risk = null;

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
     * Get risk.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getRisk()
    {
        return $this->risk;
    }

    /**
     * Set risk.
     *
     * @param mixed $risk Risk
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setRisk($risk) : void
    {
        $this->risk = $risk;
    }

    /**
     * Get title.
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title Title
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
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
     * Get raw description.
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * Set raw description.
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescriptionRaw(string $description) : void
    {
        $this->descriptionRaw = $description;
    }
}
