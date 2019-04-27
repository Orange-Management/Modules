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
use Modules\Organization\Models\PositionMapper;

/**
 * @internal
 */
class PositionMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $position = new Position();
        $position->setName('CEO');
        $position->setDescription('Description');

        $id = PositionMapper::create($position);

        $positionR = PositionMapper::get($id);
        self::assertEquals($id, $positionR->getId());
        self::assertEquals($position->getName(), $positionR->getName());
        self::assertEquals($position->getDescription(), $positionR->getDescription());
        self::assertInstanceOf('Modules\Organization\Models\NullPosition', $positionR->getParent());
    }

    /**
     * @group         volume
     * @slowThreshold 15000
     */
    public function testVolume() : void
    {
        /* 4 */
        $position = new Position();
        $position->setName('CFO');
        $position->setDescription('Description');
        $position->setParent(1);
        $id = PositionMapper::create($position);

        /* 5 */
        $position = new Position();
        $position->setName('Accountant');
        $position->setDescription('Description');
        $position->setParent($id);
        PositionMapper::create($position);

        /* 6 */
        $position = new Position();
        $position->setName('Controller');
        $position->setDescription('Description');
        $position->setParent($id);
        PositionMapper::create($position);

        /* 7 */
        $position = new Position();
        $position->setName('Sales Director');
        $position->setDescription('Description');
        $position->setParent(1);
        PositionMapper::create($position);

        /* 8 */
        $position = new Position();
        $position->setName('Purchase Director');
        $position->setDescription('Description');
        $position->setParent(1);
        PositionMapper::create($position);

        /* 9 */
        $position = new Position();
        $position->setName('Territory Manager');
        $position->setDescription('Description');
        $position->setParent(5);
        PositionMapper::create($position);

        /* 10 */
        $position = new Position();
        $position->setName('Territory Sales Assistant');
        $position->setDescription('Description');
        $position->setParent(7);
        PositionMapper::create($position);

        /* 11 */
        $position = new Position();
        $position->setName('Domestic Sales Manager');
        $position->setDescription('Description');
        $position->setParent(5);
        PositionMapper::create($position);
    }
}
