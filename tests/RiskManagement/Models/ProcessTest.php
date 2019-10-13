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

use Modules\RiskManagement\Models\Process;

/**
 * @internal
 */
class ProcessTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $obj = new Process();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->getTitle());
        self::assertEquals('', $obj->getDescription());
        self::assertEquals('', $obj->getDescriptionRaw());
        self::assertNull($obj->getDepartment());
        self::assertEquals(1, $obj->getUnit());
        self::assertNull($obj->getResponsible());
        self::assertNull($obj->getDeputy());
    }

    public function testSetGet() : void
    {
        $obj = new Process();

        $obj->setTitle('Name');
        self::assertEquals('Name', $obj->getTitle());

        $obj->setDescriptionRaw('Description');
        self::assertEquals('Description', $obj->getDescriptionRaw());

        $obj->setResponsible(1);
        self::assertEquals(1, $obj->getResponsible());

        $obj->setDeputy(1);
        self::assertEquals(1, $obj->getDeputy());

        $obj->setUnit(1);
        self::assertEquals(1, $obj->getUnit());

        $obj->setDepartment(2);
        self::assertEquals(2, $obj->getDepartment());
    }
}
