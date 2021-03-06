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

namespace Modules\tests\SupplierManagement\Models;

use Modules\SupplierManagement\Models\Supplier;
use Modules\SupplierManagement\Models\SupplierMapper;
use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;
use phpOMS\Utils\RnG\Name;

/**
 * @internal
 */
class SupplierMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\SupplierManagement\Models\SupplierMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $supplier = new Supplier();

        $supplier->getProfile()->getAccount()->setName1('Name1');
        $supplier->getProfile()->getAccount()->setName2('Name2');
        $supplier->getProfile()->getAccount()->setName3('Name3');
        $supplier->getProfile()->getAccount()->setEmail('d.test@duckburg.com');
        $supplier->getProfile()->getAccount()->setStatus(AccountStatus::ACTIVE);
        $supplier->getProfile()->getAccount()->setType(AccountType::USER);

        $supplier->setNumber('1');
        $supplier->setReverseNumber('asdf');
        $supplier->setStatus(2);
        $supplier->setType(3);
        $supplier->setTaxId(5);
        $supplier->setInfo('Some info.');

        $id = SupplierMapper::create($supplier);
        self::assertGreaterThan(0, $supplier->getId());
        self::assertEquals($id, $supplier->getId());

        $supplierR = SupplierMapper::get($supplier->getId());
        self::assertEquals($supplier->getCreatedAt()->format('Y-m-d'), $supplierR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($supplier->getProfile()->getAccount()->getName1(), $supplierR->getProfile()->getAccount()->getName1());
        self::assertEquals($supplier->getProfile()->getAccount()->getName2(), $supplierR->getProfile()->getAccount()->getName2());
        self::assertEquals($supplier->getProfile()->getAccount()->getName3(), $supplierR->getProfile()->getAccount()->getName3());
        self::assertEquals($supplier->getProfile()->getAccount()->getStatus(), $supplierR->getProfile()->getAccount()->getStatus());
        self::assertEquals($supplier->getProfile()->getAccount()->getType(), $supplierR->getProfile()->getAccount()->getType());
        self::assertEquals($supplier->getProfile()->getAccount()->getEmail(), $supplierR->getProfile()->getAccount()->getEmail());

        self::assertEquals('1', $supplier->getNumber());
        self::assertEquals('asdf', $supplier->getReverseNumber());
        self::assertEquals(2, $supplier->getStatus());
        self::assertEquals(3, $supplier->getType());
        self::assertEquals(5, $supplier->getTaxId());
        self::assertEquals('Some info.', $supplier->getInfo());
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 100; ++$i) {
            $supplier = new Supplier();

            $supplier->getProfile()->getAccount()->setName1(Name::generateName(['female', 'male']));
            $supplier->getProfile()->getAccount()->setName2(Name::generateName(['family']));
            $supplier->getProfile()->getAccount()->setStatus(AccountStatus::ACTIVE);
            $supplier->getProfile()->getAccount()->setType(AccountType::USER);

            $supplier->setNumber((string) ($i + 1));
            $supplier->setStatus(2);
            $supplier->setType(3);

            $id = SupplierMapper::create($supplier);
        }
    }
}
