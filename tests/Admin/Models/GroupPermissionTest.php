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

use Modules\Admin\Models\GroupPermission;

/**
 * @testdox Modules\tests\Admin\Models\GroupPermissionTest: Group permission
 *
 * @internal
 */
class GroupPermissionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testdox The group permission has the expected default values after initialization
     * @covers Modules\Admin\Models\GroupPermission
     * @group module
     */
    public function testDefault() : void
    {
        $group = new GroupPermission();
        self::assertEquals(0, $group->getGroup());
    }
}
