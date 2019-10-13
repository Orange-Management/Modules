<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\tests\HumanResourceManagement\Models;

use Modules\HumanResourceManagement\Models\Employee;
use Modules\HumanResourceManagement\Models\EmployeeMapper;
use Modules\Profile\Models\ProfileMapper;

/**
 * @internal
 */
class EmployeeMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $employee = new Employee(ProfileMapper::get(1));

        $id = EmployeeMapper::create($employee);
        self::assertGreaterThan(0, $employee->getId());
        self::assertEquals($id, $employee->getId());

        $employeeR = EmployeeMapper::get($employee->getId());
    }
}
