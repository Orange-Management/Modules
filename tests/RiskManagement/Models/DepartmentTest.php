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

class DepartmentTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult() : void
    {
        $obj = new Department();

        self::assertEquals(0, $obj->getId());
        self::assertInstanceOf('Modules\Organization\Models\NullDepartment', $obj->getDepartment());
        self::assertEquals(null, $obj->getResponsible());
        self::assertEquals(null, $obj->getDeputy());
    }

    public function testSetGet() : void
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
