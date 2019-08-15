<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\RiskManagement\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

/**
 * Risk Management class.
 *
 * @package    Modules\RiskManagement\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class Project
{
    private $id = 0;

    private $project = null;

    private $responsible = null;

    private $deputy = null;

    public function __construct()
    {
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setProject($project) : void
    {
        $this->project = $project;
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
