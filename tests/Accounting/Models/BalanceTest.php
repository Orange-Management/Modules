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

namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\Balance;

/**
 * @internal
 */
class BalanceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\Balance
     * @group module
     */
    public function testDefault() : void
    {
        $balance = new Balance();

        self::assertEquals(0, $balance->getId());
        self::assertEquals('', $balance->getName());
        self::assertEquals('', $balance->getDescription());
    }

    /**
     * @covers Modules\Accounting\Models\Balance
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $balance = new Balance();

        $balance->setName('Name');
        self::assertEquals('Name', $balance->getName());
    }

    /**
     * @covers Modules\Accounting\Models\Balance
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $balance = new Balance();

        $balance->setDescription('Description');
        self::assertEquals('Description', $balance->getDescription());
    }
}
