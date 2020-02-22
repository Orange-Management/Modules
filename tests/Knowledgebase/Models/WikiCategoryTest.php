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

namespace Modules\tests\Knowledgebase\Models;

use Modules\Knowledgebase\Models\WikiCategory;

/**
 * @internal
 */
class WikiCategoryTest extends \PHPUnit\Framework\TestCase
{
    protected WikiCategory $category;

    protected function setUp() : void
    {
        $this->category = new WikiCategory();
    }

    public function testDefault() : void
    {
        self::assertEquals(0, $this->category->getId());
        self::assertEquals(null, $this->category->getApp());
        self::assertEquals('', $this->category->getName());
        self::assertEquals('/', $this->category->getPath());
        self::assertNull($this->category->getParent());
    }

    public function testAppInputOutput() : void
    {
        $this->category->setApp(2);
        self::assertEquals(2, $this->category->getApp());
    }

    public function testNameInputOutput() : void
    {
        $this->category->setName('Category Name');
        self::assertEquals('Category Name', $this->category->getName());
    }

    public function testPathInputOutput() : void
    {
        $this->category->setPath('/test/path');
        self::assertEquals('/test/path', $this->category->getPath());
    }

    public function testParentInputOutput() : void
    {
        $this->category->setParent(2);
        self::assertEquals(2, $this->category->getParent());
    }
}
