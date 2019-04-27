<?php declare(strict_types=1);
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

namespace Modules\tests\Organization\Models;

use Modules\Organization\Models\Position;
use Modules\Organization\Models\Status;

/**
 * @internal
 */
class PositionTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $position = new Position();

        self::assertEquals(0, $position->getId());
        self::assertEquals('', $position->getName());
        self::assertEquals('', $position->getDescription());
        self::assertInstanceOf('Modules\Organization\Models\NullPosition', $position->getParent());
        self::assertEquals(Status::INACTIVE, $position->getStatus());
        self::assertInstanceOf('\Modules\Organization\Models\NullDepartment', $position->getDepartment());
    }

    public function testSetGet() : void
    {
        $position = new Position();

        $position->setName('Name');
        self::assertEquals('Name', $position->getName());

        $position->setStatus(Status::ACTIVE);
        self::assertEquals(Status::ACTIVE, $position->getStatus());

        $position->setDepartment(1);
        self::assertEquals(1, $position->getDepartment());

        $position->setDescription('Description');
        self::assertEquals('Description', $position->getDescription());

        $position->setParent(1);
        self::assertEquals(1, $position->getParent());
    }
}
