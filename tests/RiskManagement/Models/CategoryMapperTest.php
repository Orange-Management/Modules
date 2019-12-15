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

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Category;
use Modules\RiskManagement\Models\CategoryMapper;

/**
 * @internal
 */
class CategoryMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $obj = new Category();
        $obj->setTitle('Name');
        $obj->setDescriptionRaw('Description');
        $obj->setResponsible(1);
        $obj->setDeputy(1);

        CategoryMapper::create($obj);

        $objR = CategoryMapper::get($obj->getId());
        self::assertEquals($obj->getTitle(), $objR->getTitle());
        self::assertEquals($obj->getDescriptionRaw(), $objR->getDescriptionRaw());
        self::assertEquals($obj->getResponsible(), $objR->getResponsible());
        self::assertEquals($obj->getDeputy(), $objR->getDeputy());
    }
}
