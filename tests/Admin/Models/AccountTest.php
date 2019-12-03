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

namespace Modules\tests\Admin\Models;

use Modules\Admin\Models\Account;

/**
 * @internal
 */
class AccountTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Admin\Models\Account
     * @group module
     */
    public function testDefault() : void
    {
        $account = new Account();
        self::assertEquals(0, $account->getLoginTries());
    }

    /**
     * @covers Modules\Admin\Models\Account
     * @group module
     */
    public function testChangingLoginTries() : void
    {
        $account = new Account();

        $account->setLoginTries(3);
        self::assertEquals(3, $account->getLoginTries());
    }
}
