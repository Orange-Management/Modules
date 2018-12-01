<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\RiskManagement\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

/**
 * Risk Management class.
 *
 * @package    Modules\RiskManagement\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class Process
{
    private $id = 0;

    private $title = '';

    private $description = '';

    private $descriptionRaw = '';

    private $department = null;

    private $responsible = null;

    private $deputy = null;

    private $unit = 1;

    public function __construct()
    {
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

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

    public function getUnit()
    {
        return $this->unit;
    }

    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment($department)
    {
        $this->department = $department;
    }

    public function getResponsible()
    {
        return $this->responsible;
    }

    public function setResponsible($responsible) : void
    {
        $this->responsible = $responsible;
    }

    public function getDeputy()
    {
        return $this->deputy;
    }

    public function setDeputy($deputy) : void
    {
        $this->deputy = $deputy;
    }
}
