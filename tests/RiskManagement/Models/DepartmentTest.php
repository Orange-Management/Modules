<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Department;
use Modules\RiskManagement\Models\NullDepartment;

class DepartmentTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $obj = new Department();

        self::assertEquals(0, $obj->getId());
        self::assertInstanceOf('Modules\Organization\Models\NullDepartment', $obj->getDepartment());
        self::assertEquals(null, $obj->getResponsible());
        self::assertEquals(null, $obj->getDeputy());
    }

    public function testSetGet()
    {
        $obj = new Department();

        $obj->setDepartment(2);
        self::assertEquals(2, $obj->getDepartment());

        $obj->setResponsible(1);
        self::assertEquals(1, $obj->getResponsible());

        $obj->setDeputy(3);
        self::assertEquals(3, $obj->getDeputy());
    }
}
