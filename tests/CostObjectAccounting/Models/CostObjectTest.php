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

namespace Modules\tests\CostObjectAccounting\Models;

use Modules\CostObjectAccounting\Models\CostObject;

/**
 * @internal
 */
class CostObjectTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $co = new CostObject();
        self::assertEquals(0, $co->getId());
        self::assertEquals('', $co->getCode());
        self::assertEquals('', $co->getName());
        self::assertEquals('', $co->getDescription());
        self::assertEquals(null, $co->getParent());
    }

    public function testSetGet() : void
    {
        $co = new CostObject();

        $co->setCode('Code');
        self::assertEquals('Code', $co->getCode());

        $co->setName('Name');
        self::assertEquals('Name', $co->getName());

        $co->setDescription('Description');
        self::assertEquals('Description', $co->getDescription());

        $co->setParent(2);
        self::assertEquals(2, $co->getParent());
    }
}
