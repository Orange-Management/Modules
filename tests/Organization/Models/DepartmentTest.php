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
use Modules\Organization\Models\NullDepartment;
use Modules\Organization\Models\NullUnit;
use Modules\Organization\Models\Status;

/**
 * @internal
 */
class DepartmentTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $department = new Department();

        self::assertEquals(0, $department->getId());
        self::assertEquals('', $department->getName());
        self::assertEquals('', $department->getDescription());
        self::assertInstanceOf('Modules\Organization\Models\NullDepartment', $department->getParent());
        self::assertEquals(0, $department->getUnit()->getId());
        self::assertEquals(Status::INACTIVE, $department->getStatus());
    }

    public function testSetGet() : void
    {
        $department = new Department();

        $department->setName('Name');
        self::assertEquals('Name', $department->getName());

        $department->setStatus(Status::ACTIVE);
        self::assertEquals(Status::ACTIVE, $department->getStatus());

        $department->setDescription('Description');
        self::assertEquals('Description', $department->getDescription());

        $department->setParent(new NullDepartment(1));
        self::assertEquals(1, $department->getParent()->getId());

        $department->setUnit(new NullUnit(1));
        self::assertEquals(1, $department->getUnit()->getId());
    }
}
