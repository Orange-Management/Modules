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

namespace Modules\tests\HumanResourceManagement\Models;

use Modules\Admin\Models\Account;
use Modules\HumanResourceManagement\Models\Employee;

use Modules\Organization\Models\Department;
use Modules\Organization\Models\Position;
use Modules\Organization\Models\Unit;

class EmployeeTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $employee = new Employee();

        self::assertEquals(0, $employee->getId());
        self::assertTrue($employee->isActive());
    }

    public function testSetGet()
    {
        $employee   = new Employee();
        $account    = new Account();
        $unit       = new Unit();
        $department = new Department();
        $position   = new Position();

        $employee->setAccount($account);
        $employee->setUnit($unit);
        $employee->setDepartment($department);
        $employee->setPosition($position);
        $employee->setActivity(false);

        self::assertEquals($account->getId(), $employee->getAccount()->getId());
        self::assertEquals($unit->getId(), $employee->getUnit()->getId());
        self::assertEquals($department->getId(), $employee->getDepartment()->getId());
        self::assertEquals($position->getId(), $employee->getPosition()->getId());
        self::assertFalse($employee->isActive());
    }
}
