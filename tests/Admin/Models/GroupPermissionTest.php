<?php declare(strict_types=1);
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

namespace Modules\tests\Admin\Models;

use Modules\Admin\Models\GroupPermission;

/**
 * @internal
 */
class GroupPermissionTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $group = new GroupPermission();
        self::assertEquals(0, $group->getGroup());
    }
}
