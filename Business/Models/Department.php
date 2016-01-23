<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Business\Models;

class Department
{
    protected $id = 0;

    protected $name = '';

    protected $parent = 0;

    protected $unit = 0;

    protected $description = '';

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getParent() : int
    {
        return $this->parent;
    }

    public function getUnit() : int
    {
        return $this->parent;
    }

    public function getDescription() : string
    {
        return $this->description;
    }
}
