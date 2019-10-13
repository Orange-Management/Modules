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

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Cause;
use Modules\RiskManagement\Models\Department;
use Modules\RiskManagement\Models\Risk;
use Modules\RiskManagement\Models\Solution;

/**
 * @internal
 */
class RiskTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $obj = new Risk();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->getName());
        self::assertEquals('', $obj->getDescription());
        self::assertEquals('', $obj->getDescriptionRaw());
        self::assertEquals(1, $obj->getUnit());
        self::assertNull($obj->getDepartment());
        self::assertNull($obj->getCategory());
        self::assertNull($obj->getProcess());
        self::assertNull($obj->getProject());
        self::assertNull($obj->getResponsible());
        self::assertNull($obj->getDeputy());
        self::assertEquals([], $obj->getHistory());
        self::assertEquals([], $obj->getCauses());
        self::assertEquals([], $obj->getSolutions());
        self::assertEquals([], $obj->getRiskObjects());
        self::assertEquals([], $obj->getMedia());
    }

    public function testSetGet() : void
    {
        $obj = new Risk();

        $obj->setName('Name');
        self::assertEquals('Name', $obj->getName());

        $obj->setDescriptionRaw('Description');
        self::assertEquals('Description', $obj->getDescriptionRaw());

        $obj->setUnit(1);
        self::assertEquals(1, $obj->getUnit());

        $obj->setCategory(3);
        self::assertEquals(3, $obj->getCategory());

        $obj->setProcess(4);
        self::assertEquals(4, $obj->getProcess());

        $department = new Department();
        $department->setDepartment(1);
        $obj->setDepartment($department);

        $obj->setResponsible(1);
        self::assertEquals(1, $obj->getResponsible());

        $obj->setDeputy(1);
        self::assertEquals(1, $obj->getDeputy());

        $obj->addCause(new Cause());
        self::assertCount(1, $obj->getCauses());
        self::assertInstanceOf('\Modules\RiskManagement\Models\Cause', $obj->getCauses()[0]);

        $obj->addSolution(new Solution());
        self::assertCount(1, $obj->getSolutions());
        self::assertInstanceOf('\Modules\RiskManagement\Models\Solution', $obj->getSolutions()[0]);

        $obj->addRiskObject(2);
        self::assertCount(1, $obj->getRiskObjects());

        $obj->addHistory(2);
        self::assertCount(1, $obj->getHistory());

        $obj->addMedia(2);
        self::assertCount(1, $obj->getMedia());
    }
}
