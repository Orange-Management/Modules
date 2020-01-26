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

namespace Modules\tests\CostCenterAccounting\Models;

use Modules\CostCenterAccounting\Models\CostCenter;

/**
 * @internal
 */
class CostCenterTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $cc = new CostCenter();
        self::assertEquals(0, $cc->getId());
        self::assertEquals('', $cc->getName());
        self::assertEquals('', $cc->getCode());
        self::assertEquals('', $cc->getDescription());
        self::assertNull($cc->getParent());
    }

    public function testSetGet() : void
    {
        $cc = new CostCenter();

        $cc->setCode('Code');
        self::assertEquals('Code', $cc->getCode());

        $cc->setName('Name');
        self::assertEquals('Name', $cc->getName());

        $cc->setDescription('Description');
        self::assertEquals('Description', $cc->getDescription());

        $cc->setParent(2);
        self::assertEquals(2, $cc->getParent());
    }
}
