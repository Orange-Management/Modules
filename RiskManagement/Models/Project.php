<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\RiskManagement\Models;

/**
 * Risk Management class.
 *
 * @category   Modules
 * @package    Modules\RiskManagement
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
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

    public function setProject(string $project)
    {
        $this->project = $project;
    }

    public function getResponsible() 
    {
        return $this->responsible;
    }

    public function setResponsible($responsible) /* : void */
    {
        $this->responsible = $responsible;
    }

    public function getDeputy() 
    {
        return $this->deputy;
    }

    public function setDeputy($deputy) /* : void */
    {
        $this->deputy = $deputy;
    }
}