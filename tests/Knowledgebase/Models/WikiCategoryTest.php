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
 * @testdox Modules\tests\Knowledgebase\Models\WikiCateboryTest: Wiki category
 *
 * @internal
 */
class WikiCategoryTest extends \PHPUnit\Framework\TestCase
{
    protected WikiCategory $category;

    protected function setUp() : void
    {
        $this->category = new WikiCategory();
    }


    /**
     * @testdox The model has the expected default values after initialization
     * @covers Modules\Knowledgebase\Models\WikiApp
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->category->getId());
        self::assertNull($this->category->getApp());
        self::assertEquals('', $this->category->getName());
        self::assertEquals('/', $this->category->getPath());
        self::assertNull($this->category->getParent());
    }

    /**
     * @testdox The application can correctly set and returned
     * @covers Modules\Knowledgebase\Models\WikiApp
     * @group module
     */
    public function testAppInputOutput() : void
    {
        $this->category->setApp(2);
        self::assertEquals(2, $this->category->getApp());
    }

    /**
     * @testdox The name can correctly set and returned
     * @covers Modules\Knowledgebase\Models\WikiApp
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $this->category->setName('Category Name');
        self::assertEquals('Category Name', $this->category->getName());
    }

    /**
     * @testdox The path can correctly set and returned
     * @covers Modules\Knowledgebase\Models\WikiApp
     * @group module
     */
    public function testPathInputOutput() : void
    {
        $this->category->setPath('/test/path');
        self::assertEquals('/test/path', $this->category->getPath());
    }

    /**
     * @testdox The parent can correctly set and returned
     * @covers Modules\Knowledgebase\Models\WikiApp
     * @group module
     */
    public function testParentInputOutput() : void
    {
        $this->category->setParent(2);
        self::assertEquals(2, $this->category->getParent());
    }
}
