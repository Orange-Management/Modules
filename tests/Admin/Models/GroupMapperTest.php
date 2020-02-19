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

use Modules\Admin\Models\Group;
use Modules\Admin\Models\GroupMapper;
use Modules\Admin\Models\GroupPermission;
use Modules\Admin\Models\GroupPermissionMapper;

/**
 * @testdox Modules\tests\Admin\Models\GroupMapperTest: Group mapper
 *
 * @internal
 */
class GroupMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testdox All groups which have permissions for a module can be returned
     * @covers Modules\Admin\Models\GroupMapper
     * @group module
     */
    public function testGroupPermissionForModule() : void
    {
        $group   = new Group('test');
        $groupId = GroupMapper::create($group);

        $permission = new GroupPermission($groupId, null, null, 'Admin');
        GroupPermissionMapper::create($permission);

        $permissions = GroupMapper::getPermissionForModule('Admin');

        foreach ($permissions as $p) {
            if ($p->getId() === $groupId) {
                self::assertTrue(true);
                return;
            }
        }

        self::assertTrue(false);
    }
}
