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
use Modules\Knowledgebase\Models\WikiCategoryMapper;
use phpOMS\Utils\RnG\Text;

/**
 * @internal
 */
class WikiCategoryMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $category = new WikiCategory();

        $category->setName('Test Category');

        $id = WikiCategoryMapper::create($category);
        self::assertGreaterThan(0, $category->getId());
        self::assertEquals($id, $category->getId());

        $categoryR = WikiCategoryMapper::get($category->getId());
        self::assertEquals($category->getName(), $categoryR->getName());
    }

    public function testChildCRUD() : void
    {
        $category = new WikiCategory();

        $category->setName('Test Category2');
        $category->setParent(1);

        $id = WikiCategoryMapper::create($category);
        self::assertGreaterThan(0, $category->getId());
        self::assertEquals($id, $category->getId());

        $categoryR = WikiCategoryMapper::get($category->getId());
        self::assertEquals($category->getName(), $categoryR->getName());
        self::assertEquals($category->getParent(), $categoryR->getParent());
    }

    /**
     * @group volume
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 30; ++$i) {
            $text     = new Text();
            $category = new WikiCategory();

            $category->setName($text->generateText(\mt_rand(1, 3)));

            $id = WikiCategoryMapper::create($category);
        }
    }
}
