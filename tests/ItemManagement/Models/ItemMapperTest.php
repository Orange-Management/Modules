<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */

namespace Modules\tests\ItemManagement\Models;

use Modules\ItemManagement\Models\Item;
use Modules\ItemManagement\Models\ItemMapper;

/**
 * @internal
 */
class ItemMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $item = new Item();

        $item->setNumber('1');
        $item->setSegment(4);
        $item->setSuccessor(5);
        $item->setInfo('info text');

        $id = ItemMapper::create($item);
        self::assertGreaterThan(0, $item->getId());
        self::assertEquals($id, $item->getId());

        $itemR = ItemMapper::get($item->getId());
        self::assertEquals($item->getNumber(), $itemR->getNumber());
        self::assertEquals($item->getSegment(), $itemR->getSegment());
        self::assertEquals($item->getInfo(), $itemR->getInfo());
    }

    /**
     * @group volume
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 1000; ++$i) {
            $item = new Item();

            $item->setNumber((string) ($i + 1));
            $item->setSegment(\mt_rand(1, 9));
            $item->setInfo('info text');

            $id = ItemMapper::create($item);
        }
    }
}
