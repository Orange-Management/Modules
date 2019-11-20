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
class Risk
{
    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Name.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $name = '';
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

    private $unit = 1;

    private $department = null;

    private $category = null;

    private $project = null;

    private $process = null;

    private $responsible = null;

    private $deputy = null;

    private $histScore = [];

    private $causes = [];

    private $solutions = [];

    private $riskObjects = [];

    private $media = [];

    private $createdAt = null;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

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
     * Add cause.
     *
     * @param mixed $cause Cause
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addCause($cause) : void
    {
        $this->causes[] = $cause;
    }

    /**
     * Get causes
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getCauses() : array
    {
        return $this->causes;
    }

    /**
     * Add solution.
     *
     * @param mixed $solution Solution
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addSolution($solution) : void
    {
        $this->solutions[] = $solution;
    }

    /**
     * Get solutions
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getSolutions() : array
    {
        return $this->solutions;
    }

    /**
     * Get media
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getMedia() : array
    {
        return $this->media;
    }

    /**
     * Add media.
     *
     * @param mixed $media Media
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addMedia($media) : void
    {
        $this->media[] = $media;
    }

    /**
     * Add risk object.
     *
     * @param mixed $object Risk object
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addRiskObject($object) : void
    {
        $this->riskObjects[] = $object;
    }

    /**
     * Get risk objects
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getRiskObjects() : array
    {
        return $this->riskObjects;
    }

    /**
     * Add history.
     *
     * @param mixed $history History
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addHistory($history) : void
    {
        $this->histScore[] = $history;
    }

    /**
     * Get history
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getHistory() : array
    {
        return $this->histScore;
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
     * Set name
     *
     * @param string $name Name
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
     * Get process.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getProcess()
    {
        return $this->process;
    }

    /**
     * Set process.
     *
     * @param mixed $process Process
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setProcess($process) : void
    {
        $this->process = $process;
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
