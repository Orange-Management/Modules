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
class Solution
{
    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;

    private $title = '';
    /**
     * Description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $description = '';
    /**
     * Description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $descriptionRaw = '';

    private $probability = 0;

    private $cause = null;

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

    public function setRisk($risk) : void
    {
        $this->risk = $risk;
    }

    public function getRisk()
    {
        return $this->risk;
    }

    public function setCause($cause) : void
    {
        $this->cause = $cause;
    }

    public function getCause()
    {
        return $this->cause;
    }

    public function getProbability() : int
    {
        return $this->probability;
    }

    public function setProbability(int $probability) : void
    {
        $this->probability = $probability;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

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

    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    public function setDescriptionRaw(string $description) : void
    {
        $this->descriptionRaw = $description;
    }
}
