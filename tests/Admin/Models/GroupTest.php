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

use Modules\Admin\Models\Group;

class GroupTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $group = new Group();
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $group->getCreatedAt()->format('Y-m-d'));
        self::assertEquals(0, $group->getCreatedBy());
        self::assertEquals('', $group->getDescriptionRaw());
        self::assertEquals([], $group->getAccounts());
    }

    public function testGetSet()
    {
        $group = new Group();

        $group->setDescriptionRaw('Some test');
        self::assertEquals('Some test', $group->getDescriptionRaw());

        $group->setCreatedBy(3);
        self::assertEquals(3, $group->getCreatedBy());
    }
}
