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
use Modules\Media\Models\Media;

/**
 * @internal
 */
class MediaTest extends \PHPUnit\Framework\TestCase
{
    protected Media $media;

    protected function setUp() : void
    {
        $this->media = new Media();
    }

    public function testDefault() : void
    {
        self::assertEquals(0, $this->media->getId());
        self::assertEquals(0, $this->media->getCreatedBy()->getId());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->media->getCreatedAt()->format('Y-m-d'));
        self::assertEquals('', $this->media->getExtension());
        self::assertEquals('', $this->media->getPath());
        self::assertFalse($this->media->isAbsolute());
        self::assertEquals('', $this->media->getName());
        self::assertEquals('', $this->media->getDescription());
        self::assertEquals('', $this->media->getDescriptionRaw());
        self::assertEquals('/', $this->media->getVirtualPath());
        self::assertEquals(0, $this->media->getSize());
        self::assertFalse($this->media->isVersioned());
    }

    public function testCreatedByInputOutput() : void
    {
        $this->media->setCreatedBy(new NullAccount(1));
        self::assertEquals(1, $this->media->getCreatedBy()->getId());
    }

    public function testExtensionInputOutput() : void
    {
        $this->media->setExtension('pdf');
        self::assertEquals('pdf', $this->media->getExtension());
    }

    public function testPathInputOutput() : void
    {
        $this->media->setPath('/home/root');
        self::assertEquals('/home/root', $this->media->getPath());
    }

    public function testAbsolutePathInputOutput() : void
    {
        $this->media->setAbsolute(true);
        self::assertTrue($this->media->isAbsolute());
    }

    public function testNameInputOutput() : void
    {
        $this->media->setName('Report');
        self::assertEquals('Report', $this->media->getName());
    }

    public function testDescriptionInputOutput() : void
    {
        $this->media->setDescription('This is a description');
        self::assertEquals('This is a description', $this->media->getDescription());
    }

    public function testDescriptionRawInputOutput() : void
    {
        $this->media->setDescriptionRaw('This is a description raw');
        self::assertEquals('This is a description raw', $this->media->getDescriptionRaw());
    }

    public function testSizeInputOutput() : void
    {
        $this->media->setSize(11);
        self::assertEquals(11, $this->media->getSize());
    }

    public function testVersionedInputOutput() : void
    {
        $this->media->setVersioned(true);
        self::assertTrue($this->media->isVersioned());
    }

    public function testVirtualPathInputOutput() : void
    {
        $this->media->setVirtualPath('/test/path');
        self::assertEquals('/test/path', $this->media->getVirtualPath());
    }

    public function testHiddenInputOutput() : void
    {
        $this->media->setHidden(true);
        self::assertTrue($this->media->isHidden());
    }
}
