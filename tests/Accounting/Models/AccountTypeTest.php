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

use Modules\Accounting\Models\AccountType;

/**
 * @internal
 */
class AccountTypeTest extends \PHPUnit\Framework\TestCase
{
    public function testEnums() : void
    {
        self::assertCount(4, AccountType::getConstants());
        self::assertEquals(AccountType::getConstants(), \array_unique(AccountType::getConstants()));

        self::assertEquals(0, AccountType::IMPERSONAL);
        self::assertEquals(1, AccountType::PERSONAL);
        self::assertEquals(2, AccountType::CREDITOR);
        self::assertEquals(4, AccountType::DEBITOR);
    }
}
