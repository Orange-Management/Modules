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
     * Get category.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category.
     *
     * @param mixed $category Category
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCategory($category) : void
    {
        $this->category = $category;
    }

    /**
     * Get probability.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getProbability() : int
    {
        return $this->probability;
    }

    /**
     * Set probability.
     *
     * @param int $probability Probability
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setProbability(int $probability) : void
    {
        $this->probability = $probability;
    }

    /**
     * Get department.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set department.
     *
     * @param mixed $department Department
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDepartment($department) : void
    {
        $this->department = $department;
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
