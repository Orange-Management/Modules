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
class Cause
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

    private $department = null;

    private $risk = null;

    private $category = null;

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

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category) : void
    {
        $this->category = $category;
    }

    public function getProbability() : int
    {
        return $this->probability;
    }

    public function setProbability(int $probability) : void
    {
        $this->probability = $probability;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment($department) : void
    {
        $this->department = $department;
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
