<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Department;
use Modules\RiskManagement\Models\DepartmentMapper;

class DepartmentMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $obj = new Department();
        $obj->setDepartment(1);
        $obj->setResponsible(1);
        $obj->setDeputy(1);

        DepartmentMapper::create($obj);

        $objR = DepartmentMapper::get($obj->getId());
        self::assertEquals($obj->getDepartment(), $objR->getDepartment()->getId());
        self::assertEquals($obj->getResponsible(), $objR->getResponsible());
        self::assertEquals($obj->getDeputy(), $objR->getDeputy());
    }
}
