<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\SupplierManagement\Models;

use Modules\SupplierManagement\Models\Supplier;

class SupplierTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $supplier = new Supplier();

        self::assertEquals(0, $supplier->getNumber());
        self::assertEmpty($supplier->getReverseNumber());
        self::assertEquals(0, $supplier->getStatus());
        self::assertEquals(0, $supplier->getType());
        self::assertEmpty($supplier->getTaxId());
        self::assertEmpty($supplier->getInfo());
        self::assertInstanceOf('\DateTime', $supplier->getCreatedAt());
    }

    public function testSetGet()
    {
        $supplier = new Supplier();

        $supplier->setNumber(1);
        self::assertEquals(1, $supplier->getNumber());

        $supplier->setReverseNumber('asdf');
        self::assertEquals('asdf', $supplier->getReverseNumber());

        $supplier->setStatus(2);
        self::assertEquals(2, $supplier->getStatus());

        $supplier->setType(3);
        self::assertEquals(3, $supplier->getType());

        $supplier->setTaxId(5);
        self::assertEquals(5, $supplier->getTaxId());

        $supplier->setInfo('Some info.');
        self::assertEquals('Some info.', $supplier->getInfo());
    }
}
