<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */

namespace Modules\tests\ItemManagement\Models;

use Modules\ItemManagement\Models\Item;
use Modules\Media\Models\Media;

/**
 * @internal
 */
class ItemTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $item = new Item();

        self::assertEquals(0, $item->getId());
        self::assertEmpty('', $item->getNumber());
        self::assertEquals(0, $item->getArticleGroup());
        self::assertEquals(0, $item->getProductGroup());
        self::assertEquals(0, $item->getSegment());
        self::assertEquals(0, $item->getSuccessor());
        self::assertEmpty($item->getMedia());
        self::assertEmpty($item->getInfo());
        self::assertInstanceOf('\DateTime', $item->getCreatedAt());
    }

    public function testSetGet() : void
    {
        $item = new Item();

        $item->setNumber('1');
        self::assertEquals('1', $item->getNumber());

        $item->setArticleGroup(2);
        self::assertEquals(2, $item->getArticleGroup());

        $item->setProductGroup(3);
        self::assertEquals(3, $item->getProductGroup());

        $item->setSegment(4);
        self::assertEquals(4, $item->getSegment());

        $item->setSuccessor(5);
        self::assertEquals(5, $item->getSuccessor());

        $item->setInfo('info text');
        self::assertEquals('info text', $item->getInfo());

        $item->addMedia(new Media());
        self::assertInstanceOf('\Modules\Media\Models\Media', $item->getMedia()[0]);
    }
}
