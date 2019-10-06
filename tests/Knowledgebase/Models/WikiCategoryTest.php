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
    public function testDefault() : void
    {
        $category = new WikiCategory();

        self::assertEquals(0, $category->getId());
        self::assertEquals('', $category->getName());
        self::assertNull($category->getParent());
    }

    public function testSetGet() : void
    {
        $category = new WikiCategory();

        $category->setName('Category Name');
        $category->setParent(1);

        self::assertEquals('Category Name', $category->getName());
        self::assertEquals(1, $category->getParent());
    }
}
