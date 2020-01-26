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
class Project
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    private $project = null;

    private $responsible = null;

    private $deputy = null;

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
     * Get project.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set project.
     *
     * @param mixed $project Project
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setProject($project) : void
    {
        $this->project = $project;
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
