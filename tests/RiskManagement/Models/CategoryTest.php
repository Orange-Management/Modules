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

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Category;

class CategoryTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $obj = new Category();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->getTitle());
        self::assertEquals('', $obj->getDescription());
        self::assertEquals('', $obj->getDescriptionRaw());
        self::assertEquals(null, $obj->getParent());
        self::assertEquals(null, $obj->getResponsible());
        self::assertEquals(null, $obj->getDeputy());
    }

    public function testSetGet()
    {
        $obj = new Category();

        $obj->setTitle('Name');
        self::assertEquals('Name', $obj->getTitle());

        $obj->setDescriptionRaw('Description');
        self::assertEquals('Description', $obj->getDescriptionRaw());

        $obj->setResponsible(1);
        self::assertEquals(1, $obj->getResponsible());

        $obj->setDeputy(1);
        self::assertEquals(1, $obj->getDeputy());

        $obj->setParent(1);
        self::assertEquals(1, $obj->getParent());
    }
}
