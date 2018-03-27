<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\Media\Models;

use Modules\Media\Models\Collection;

class CollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $media = new Collection();

        self::assertEquals(0, $media->getId());
        self::assertEquals(0, $media->getCreatedBy());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $media->getCreatedAt()->format('Y-m-d'));
        self::assertEquals('collection', $media->getExtension());
        self::assertEquals('', $media->getPath());
        self::assertEquals('', $media->getName());
        self::assertEquals('', $media->getDescription());
        self::assertEquals(0, $media->getSize());
        self::assertEquals(false, $media->isVersioned());
        self::assertEquals([], $media->getSources());
    }

    public function testSetGet()
    {
        $media = new Collection();

        $media->setCreatedBy(1);
        self::assertEquals(1, $media->getCreatedBy());

        $media->setExtension('pdf');
        self::assertEquals('collection', $media->getExtension());

        $media->setPath('/home/root');
        self::assertEquals('/home/root', $media->getPath());

        $media->setName('Report');
        self::assertEquals('Report', $media->getName());

        $media->setDescription('This is a description');
        self::assertEquals('This is a description', $media->getDescription());

        $media->setSize(11);
        self::assertEquals(11, $media->getSize());

        $media->setVersioned(true);
        self::assertEquals(false, $media->isVersioned());

        $media->setSources([1, 2, 3]);
        self::assertEquals([1, 2, 3], $media->getSources());

        $media->addSource(4);
        self::assertEquals([1, 2, 3, 4], $media->getSources());
    }
}
