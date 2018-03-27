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

namespace Modules\tests\QA\Models;

use Modules\QA\Models\QACategory;

class QACategoryTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $category = new QACategory();

        self::assertEquals(0, $category->getId());
        self::assertEquals('', $category->getName());
        self::assertEquals(null, $category->getParent());
    }

    public function testSetGet()
    {
        $category = new QACategory();

        $category->setName('Category Name');
        $category->setParent(1);

        self::assertEquals('Category Name', $category->getName());
        self::assertEquals(1, $category->getParent());
    }
}
