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

namespace Modules\tests\Admin\Models;

use Modules\Admin\Models\Account;

class AccountTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $account = new Account();
        self::assertEquals(0, $account->getLoginTries());
    }

    public function testGetSet() : void
    {
        $account = new Account();

        $account->setLoginTries(3);
        self::assertEquals(3, $account->getLoginTries());
    }
}
