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

use Modules\Admin\Models\Account;
use Modules\HumanResourceManagement\Models\Employee;

use Modules\Organization\Models\Department;
use Modules\Organization\Models\Position;
use Modules\Organization\Models\Unit;

/**
 * @internal
 */
class EmployeeTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $employee = new Employee();

        self::assertEquals(0, $employee->getId());
    }

    public function testSetGet() : void
    {

    }
}
