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

namespace Modules\tests\Media\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\Collection;
use Modules\Media\Models\NullMedia;

/**
 * @internal
 */
class CollectionTest extends \PHPUnit\Framework\TestCase
{
    protected Collection $media;

    protected function setUp() : void
    {
        $this->media = new Collection();
    }

    public function testDefault() : void
    {
        self::assertEquals(0, $this->media->getId());
        self::assertEquals(0, $this->media->getCreatedBy()->getId());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->media->getCreatedAt()->format('Y-m-d'));
        self::assertEquals('collection', $this->media->getExtension());
        self::assertEquals('', $this->media->getPath());
        self::assertEquals('', $this->media->getName());
        self::assertEquals('', $this->media->getDescription());
        self::assertEquals(0, $this->media->getSize());
        self::assertFalse($this->media->isVersioned());
        self::assertEquals([], $this->media->getSources());
    }

    public function testCreatedByInputOutput() : void
    {
        $this->media->setCreatedBy(new NullAccount(1));
        self::assertEquals(1, $this->media->getCreatedBy()->getId());
    }

    public function testExtensionInputOutput() : void
    {
        $this->media->setExtension('pdf');
        self::assertEquals('collection', $this->media->getExtension());
    }

    public function testPathInputOutput() : void
    {
        $this->media->setPath('/home/root');
        self::assertEquals('/home/root', $this->media->getPath());
    }

    public function testDescriptionInputOutput() : void
    {
        $this->media->setDescription('This is a description');
        self::assertEquals('This is a description', $this->media->getDescription());
    }

    public function testSizeInputOutput() : void
    {
        $this->media->setSize(11);
        self::assertEquals(11, $this->media->getSize());
    }

    public function testVersionedInputOutput() : void
    {
        $this->media->setVersioned(true);
        self::assertFalse($this->media->isVersioned());
    }

    public function testSourceInputOutput() : void
    {
        $this->media->setSources([new NullMedia(1), new NullMedia(2), new NullMedia(3)]);
        self::assertEquals([new NullMedia(1), new NullMedia(2), new NullMedia(3)], $this->media->getSources());
    }

    public function testSourceAddInputOutput() : void
    {
        $this->media->setSources([new NullMedia(1), new NullMedia(2), new NullMedia(3)]);
        $this->media->addSource(new NullMedia(4));
        self::assertEquals([new NullMedia(1), new NullMedia(2), new NullMedia(3), new NullMedia(4)], $this->media->getSources());
    }
}
