<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */

namespace Modules\tests\Admin\Models;

use Modules\Admin\Models\Group;

/**
 * @internal
 */
class GroupTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $group = new Group();
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $group->getCreatedAt()->format('Y-m-d'));
        self::assertEquals(0, $group->getCreatedBy());
        self::assertEquals('', $group->getDescriptionRaw());
        self::assertEquals([], $group->getAccounts());
    }

    public function testGetSet() : void
    {
        $group = new Group();

        $group->setDescriptionRaw('Some test');
        self::assertEquals('Some test', $group->getDescriptionRaw());

        $group->setCreatedBy(3);
        self::assertEquals(3, $group->getCreatedBy());
    }
}
