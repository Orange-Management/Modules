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

use Modules\Organization\Models\NullDepartment as NullOrgDepartment;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Department
{
    private $id = 0;

    private $department = null;

    private $responsible = null;

    private $deputy = null;

    public function __construct()
    {
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getDepartment()
    {
        return $this->department ?? new NullOrgDepartment();
    }

    public function setDepartment($department) : void
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
