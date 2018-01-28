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

namespace Modules\tests\Organization\Models;

use Modules\Organization\Models\Unit;
use Modules\Organization\Models\Status;

class UnitTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $unit = new Unit();

        self::assertEquals(0, $unit->getId());
        self::assertEquals('', $unit->getName());
        self::assertEquals('', $unit->getDescription());
        self::assertInstanceOf('Modules\Organization\Models\NullUnit', $unit->getParent());
        self::assertEquals(Status::INACTIVE, $unit->getStatus());
    }

    public function testSetGet()
    {
        $unit = new Unit();

        $unit->setName('Name');
        self::assertEquals('Name', $unit->getName());

        $unit->setStatus(Status::ACTIVE);
        self::assertEquals(Status::ACTIVE, $unit->getStatus());

        $unit->setDescription('Description');
        self::assertEquals('Description', $unit->getDescription());

        $unit->setParent(1);
        self::assertEquals(1, $unit->getParent());
    }
}
