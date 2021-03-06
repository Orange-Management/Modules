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

namespace Modules\tests\Organization\Models;

use Modules\Organization\Models\Department;
use Modules\Organization\Models\DepartmentMapper;
use Modules\Organization\Models\NullDepartment;
use Modules\Organization\Models\NullUnit;

/**
 * @internal
 */
class DepartmentMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $department = new Department();
        $department->setName('Management');
        $department->setDescription('Description');
        $department->setUnit(new NullUnit(1));

        $id = DepartmentMapper::create($department);

        $departmentR = DepartmentMapper::get($id);
        self::assertEquals($id, $departmentR->getId());
        self::assertEquals($department->getName(), $departmentR->getName());
        self::assertEquals($department->getDescription(), $departmentR->getDescription());
        self::assertInstanceOf('Modules\Organization\Models\NullDepartment', $departmentR->getParent());
        self::assertEquals($department->getUnit()->getId(), $departmentR->getUnit()->getId());

    }

    /**
     * @group         volume
     * @slowThreshold 15000
     * @group module
     */
    public function testVolume() : void
    {
        $first = 2;

        /* 2 */
        $department = new Department();
        $department->setName('HR');
        $department->setDescription('Description');
        $department->setParent(new NullDepartment($first));
        $department->setUnit(new NullUnit(1));
        DepartmentMapper::create($department);

        /* 3 */
        $department = new Department();
        $department->setName('QM');
        $department->setDescription('Description');
        $department->setParent(new NullDepartment($first));
        $department->setUnit(new NullUnit(1));
        DepartmentMapper::create($department);

        /* 4 */
        $department = new Department();
        $department->setName('Sales');
        $department->setDescription('Description');
        $department->setParent(new NullDepartment($first));
        $department->setUnit(new NullUnit(1));
        DepartmentMapper::create($department);

        /* 5 */
        $department = new Department();
        $department->setName('Shipping');
        $department->setDescription('Description');
        $department->setParent(new NullDepartment($first + 3));
        $department->setUnit(new NullUnit(1));
        DepartmentMapper::create($department);

        /* 6 */
        $department = new Department();
        $department->setName('Purchase');
        $department->setDescription('Description');
        $department->setParent(new NullDepartment($first));
        $department->setUnit(new NullUnit(1));
        DepartmentMapper::create($department);

        /* 7 */
        $department = new Department();
        $department->setName('Arrival');
        $department->setDescription('Description');
        $department->setParent(new NullDepartment($first + 5));
        $department->setUnit(new NullUnit(1));
        DepartmentMapper::create($department);

        /* 8 */
        $department = new Department();
        $department->setName('Accounting');
        $department->setDescription('Description');
        $department->setParent(new NullDepartment($first));
        $department->setUnit(new NullUnit(1));
        DepartmentMapper::create($department);

        /* 9 */
        $department = new Department();
        $department->setName('Production');
        $department->setDescription('Description');
        $department->setParent(new NullDepartment($first));
        $department->setUnit(new NullUnit(1));
        DepartmentMapper::create($department);
    }
}
