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
use Modules\Admin\Models\NullAccount;

/**
 * @testdox Modules\tests\Admin\Models\GroupTest: Group model
 *
 * @internal
 */
class GroupTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testdox The group has the expected default values after initialization
     * @covers Modules\Admin\Models\Group
     * @group module
     */
    public function testDefault() : void
    {
        $group = new Group();
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $group->getCreatedAt()->format('Y-m-d'));
        self::assertEquals(0, $group->getCreatedBy()->getId());
        self::assertEquals('', $group->getDescriptionRaw());
        self::assertEquals([], $group->getAccounts());
    }

    /**
     * @testdox The description can be set and returned
     * @covers Modules\Admin\Models\Group
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $group = new Group();

        $group->setDescriptionRaw('Some test');
        self::assertEquals('Some test', $group->getDescriptionRaw());
    }

    /**
     * @testdox The creator can be set and returned
     * @covers Modules\Admin\Models\Group
     * @group module
     */
    public function testCreatorInputOutput() : void
    {
        $group = new Group();

        $group->setCreatedBy(new NullAccount(3));
        self::assertEquals(3, $group->getCreatedBy()->getId());
    }
}
