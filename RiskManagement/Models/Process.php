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
class Process
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

    private $department = null;

    private $responsible = null;

    private $deputy = null;

    private $unit = 1;

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

    /**
     * Get unit.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set unit.
     *
     * @param mixed $unit Unit
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setUnit($unit) : void
    {
        $this->unit = $unit;
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
     * Get responsible.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * Set responsible.
     *
     * @param mixed $responsible Responsible
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setResponsible($responsible) : void
    {
        $this->responsible = $responsible;
    }

    /**
     * Get deputy.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getDeputy()
    {
        return $this->deputy;
    }

    /**
     * Set deputy.
     *
     * @param mixed $deputy Deputy
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDeputy($deputy) : void
    {
        $this->deputy = $deputy;
    }
}
