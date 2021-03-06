<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    tests
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\tests\SupplierManagement\Models;

use Modules\SupplierManagement\Models\Supplier;

/**
 * @internal
 */
class SupplierTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $supplier = new Supplier();

        self::assertEquals('', $supplier->getNumber());
        self::assertEmpty($supplier->getReverseNumber());
        self::assertEquals(0, $supplier->getStatus());
        self::assertEquals(0, $supplier->getType());
        self::assertEmpty($supplier->getTaxId());
        self::assertEmpty($supplier->getInfo());
        self::assertInstanceOf('\DateTime', $supplier->getCreatedAt());
    }

    public function testSetGet() : void
    {
        $supplier = new Supplier();

        $supplier->setNumber('1');
        self::assertEquals('1', $supplier->getNumber());

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
