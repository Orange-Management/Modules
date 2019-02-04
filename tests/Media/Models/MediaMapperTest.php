<?php
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

namespace Modules\tests\Media\Models;

use Modules\Media\Models\Media;
use Modules\Media\Models\MediaMapper;

class MediaMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $media = new Media();
        $media->setCreatedBy(1);
        $media->setDescription('desc');
        $media->setDescriptionRaw('descRaw');
        $media->setPath('some/path');
        $media->setSize(11);
        $media->setExtension('png');
        $media->setName('Image');
        $id = MediaMapper::create($media);

        self::assertGreaterThan(0, $media->getId());
        self::assertEquals($id, $media->getId());

        $mediaR = MediaMapper::get($media->getId());
        self::assertEquals($media->getCreatedAt()->format('Y-m-d'), $mediaR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($media->getCreatedBy(), $mediaR->getCreatedBy()->getId());
        self::assertEquals($media->getDescription(), $mediaR->getDescription());
        self::assertEquals($media->getDescriptionRaw(), $mediaR->getDescriptionRaw());
        self::assertEquals($media->getPath(), $mediaR->getPath());
        self::assertEquals($media->isAbsolute(), $mediaR->isAbsolute());
        self::assertEquals($media->getSize(), $mediaR->getSize());
        self::assertEquals($media->getExtension(), $mediaR->getExtension());
        self::assertEquals($media->getName(), $mediaR->getName());
    }

    public function testAbsolute() : void
    {
        $media = new Media();
        $media->setCreatedBy(1);
        $media->setDescription('desc');
        $media->setPath('https://avatars0.githubusercontent.com/u/16034994');
        $media->setAbsolute(true);
        $media->setSize(11);
        $media->setExtension('png');
        $media->setName('Absolute path');
        $id = MediaMapper::create($media);

        self::assertGreaterThan(0, $media->getId());
        self::assertEquals($id, $media->getId());

        $mediaR = MediaMapper::get($media->getId());
        self::assertEquals($media->getCreatedAt()->format('Y-m-d'), $mediaR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($media->getCreatedBy(), $mediaR->getCreatedBy()->getId());
        self::assertEquals($media->getDescription(), $mediaR->getDescription());
        self::assertEquals($media->getPath(), $mediaR->getPath());
        self::assertEquals($media->isAbsolute(), $mediaR->isAbsolute());
        self::assertEquals($media->getSize(), $mediaR->getSize());
        self::assertEquals($media->getExtension(), $mediaR->getExtension());
        self::assertEquals($media->getName(), $mediaR->getName());
    }

    public function testDirectoryMapping() : void
    {
        $media = new Media();
        $media->setCreatedBy(1);
        $media->setDescription('desc');
        $media->setPath(\realpath(__DIR__ . '/../../../../../'));
        $media->setAbsolute(true);
        $media->setSize(11);
        $media->setExtension('collection');
        $media->setName('Directory');
        $id = MediaMapper::create($media);

        self::assertGreaterThan(0, $media->getId());
        self::assertEquals($id, $media->getId());

        $mediaR = MediaMapper::get($media->getId());
        self::assertEquals($media->getCreatedAt()->format('Y-m-d'), $mediaR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($media->getCreatedBy(), $mediaR->getCreatedBy()->getId());
        self::assertEquals($media->getDescription(), $mediaR->getDescription());
        self::assertEquals($media->getPath(), $mediaR->getPath());
        self::assertEquals($media->isAbsolute(), $mediaR->isAbsolute());
        self::assertEquals($media->getSize(), $mediaR->getSize());
        self::assertEquals($media->getExtension(), $mediaR->getExtension());
        self::assertEquals($media->getName(), $mediaR->getName());
    }
}
