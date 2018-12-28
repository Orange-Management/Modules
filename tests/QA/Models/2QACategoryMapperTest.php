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

namespace Modules\tests\QA\Models;

use Modules\QA\Models\QACategory;
use Modules\QA\Models\QACategoryMapper;
use phpOMS\Utils\RnG\Text;

class QACategoryMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $category = new QACategory();

        $category->setName('Test Category');

        $id = QACategoryMapper::create($category);
        self::assertGreaterThan(0, $category->getId());
        self::assertEquals($id, $category->getId());

        $categoryR = QACategoryMapper::get($category->getId());
        self::assertEquals($category->getName(), $categoryR->getName());
    }

    public function testChildCRUD() : void
    {
        $category = new QACategory();

        $category->setName('Test Category2');
        $category->setParent(1);

        $id = QACategoryMapper::create($category);
        self::assertGreaterThan(0, $category->getId());
        self::assertEquals($id, $category->getId());

        $categoryR = QACategoryMapper::get($category->getId());
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
            $category = new QACategory();

            $category->setName($text->generateText(mt_rand(1, 3)));

            $id = QACategoryMapper::create($category);
        }
    }
}
