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

namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\Balance;

class BalanceTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $balance = new Balance();
        self::assertEquals(0, $balance->getId());
        self::assertEquals('', $balance->getName());
        self::assertEquals('', $balance->getDescription());
    }

    public function testGetSet()
    {
        $balance = new Balance();

        $balance->setName('Name');
        self::assertEquals('Name', $balance->getName());

        $balance->setDescription('Description');
        self::assertEquals('Description', $balance->getDescription());
    }
}
