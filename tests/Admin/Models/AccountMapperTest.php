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
use Modules\Admin\Models\AccountMapper;
use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;
use phpOMS\Auth\LoginReturnType;

/**
 * @testdox Modules\tests\Admin\Models\LocalizationMapperTest: Account database mapper
 *
 * @internal
 */
class AccountMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testdox The model can be created and read from the database
     * @covers Modules\Admin\Models\AccountMapper
     * @group module
     */
    public function testCR() : void
    {
        $account = new Account();

        $account->setName('TestLogin');
        $account->setName1('Donald');
        $account->setName2('Fauntleroy');
        $account->setName3('Duck');
        $account->setLoginTries(3);
        $account->setEmail('d.duck@duckburg.com');
        $account->setStatus(AccountStatus::ACTIVE);
        $account->setType(AccountType::USER);

        $id = AccountMapper::create($account);
        self::assertGreaterThan(0, $account->getId());
        self::assertEquals($id, $account->getId());

        $accountR = AccountMapper::get($account->getId());
        self::assertEquals($account->getCreatedAt()->format('Y-m-d'), $accountR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($account->getName(), $accountR->getName());
        self::assertEquals($account->getName1(), $accountR->getName1());
        self::assertEquals($account->getName2(), $accountR->getName2());
        self::assertEquals($account->getName3(), $accountR->getName3());
        self::assertEquals($account->getStatus(), $accountR->getStatus());
        self::assertEquals($account->getType(), $accountR->getType());
        self::assertEquals($account->getEmail(), $accountR->getEmail());
        self::assertEquals($account->getLoginTries(), $accountR->getLoginTries());
    }

    /**
     * @testdox A empty user password results in a failed login
     * @covers Modules\Admin\Models\AccountMapper
     * @group module
     */
    public function testEmptyPasswordLogin() : void
    {
        self::assertEquals(LoginReturnType::WRONG_PASSWORD, AccountMapper::login('admin', ''));
    }

    /**
     * @testdox A invalid user password results in a failed login
     * @covers Modules\Admin\Models\AccountMapper
     * @group module
     */
    public function testInvalidPasswordLogin() : void
    {
        self::assertEquals(LoginReturnType::WRONG_PASSWORD, AccountMapper::login('admin', 'invalid'));
    }

    /**
     * @testdox A invalid user name results in a failed login
     * @covers Modules\Admin\Models\AccountMapper
     * @group module
     */
    public function testInvalidUsernameLogin() : void
    {
        self::assertEquals(LoginReturnType::WRONG_USERNAME, AccountMapper::login('zzzzInvalidTestzzz', 'orange'));
    }

    /**
     * @testdox A valid user name and password results in a successful login
     * @covers Modules\Admin\Models\AccountMapper
     * @group module
     */
    public function testValidLogin() : void
    {
        self::assertGreaterThan(0, AccountMapper::login('admin', 'orange'));
    }
}
