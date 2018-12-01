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

use Modules\Admin\Models\AccountPermission;

final class AccountPermissionTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $account = new AccountPermission();
        self::assertEquals(0, $account->getAccount());
    }
}
