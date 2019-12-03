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
 * @internal
 */
class AccountPermissionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Admin\Models\AccountPermission
     * @group module
     */
    public function testDefault() : void
    {
        $account = new AccountPermission();
        self::assertEquals(0, $account->getAccount());
    }
}
