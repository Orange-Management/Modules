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

use Modules\Organization\Models\Unit;
use Modules\Organization\Models\Department;
use Modules\Organization\Models\Position;

use Modules\Admin\Models\Account;
use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;
use Modules\Admin\Models\AccountMapper;

use Modules\HumanResourceManagement\Models\Employee;
use Modules\HumanResourceManagement\Models\EmployeeMapper;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Utils\RnG\Name;

final class EmployeeMapperTest extends \PHPUnit\Framework\TestCase
{
    private static $unitId       = 0;
    private static $departmentId = 0;
    private static $positionId   = 0;

    public function testCRUD()
    {
        $employee = new Employee();
        $employee->setAccount(AccountMapper::get(1));

        $unit = new Unit();
        $unit->setName('Flintheart Inc.');
        $unit->setDescription('Description');
        $unit->setParent(1);

        $employee->setUnit($unit);

        $department = new Department();
        $department->setName('Marketing');
        $department->setDescription('Description');
        $department->setUnit($unit);

        $employee->setDepartment($department);

        $position = new Position();
        $position->setName('Marketer');
        $position->setDescription('Description');

        $employee->setPosition($position);

        $id = EmployeeMapper::create($employee);
        self::assertGreaterThan(0, $employee->getId());
        self::assertEquals($id, $employee->getId());

        $employeeR = EmployeeMapper::get($employee->getId());
        self::assertEquals($employee->getAccount()->getName1(), $employeeR->getAccount()->getName1());
        self::assertEquals($employee->getUnit()->getName(), $employeeR->getUnit()->getName());
        self::assertEquals($employee->getDepartment()->getName(), $employeeR->getDepartment()->getName());
        self::assertEquals($employee->getPosition()->getName(), $employeeR->getPosition()->getName());
        self::assertEquals($employee->isActive(), $employeeR->isActive());

        self::$unitId       = $employeeR->getUnit()->getId();
        self::$departmentId = $employeeR->getDepartment()->getId();
        self::$positionId   = $employeeR->getPosition()->getId();
    }

    /**
     * @group volume
     */
    public function testVolume()
    {
        for ($i = 1; $i < 100; ++$i) {
            $employee = new Employee();

            $account = new Account();
            $account->setName1(Name::generateName(['female', 'male']));
            $account->setName3(Name::generateName(['family']));
            $account->setStatus(AccountStatus::ACTIVE);
            $account->setType(AccountType::USER);
            $employee->setAccount($account);

            $employee->setUnit(self::$unitId);
            $employee->setDepartment(self::$departmentId);
            $employee->setPosition(self::$positionId);

            $id = EmployeeMapper::create($employee);
        }
    }
}
