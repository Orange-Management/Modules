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

use Modules\Admin\Models\AccountPermission;

/**
 * @testdox Modules\tests\Admin\Models\AccountPermissionTest: Account permission
 *
 * @internal
 */
class AccountPermissionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testdox The account permission has the expected default values after initialization
     * @covers Modules\Admin\Models\AccountPermission
     * @group module
     */
    public function testDefault() : void
    {
        $account = new AccountPermission();
        self::assertEquals(0, $account->getAccount());
    }
}
