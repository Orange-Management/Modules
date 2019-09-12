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

namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\CostObject;

/**
 * @internal
 */
class CostObjectTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $cc = new CostObject();
        self::assertEquals(0, $cc->getId());
        self::assertEquals('', $cc->getName());
        self::assertEquals('', $cc->getDescription());
    }

    public function testSetGet() : void
    {
        $cc = new CostObject();

        $cc->setName('Name');
        self::assertEquals('Name', $cc->getName());

        $cc->setDescription('Description');
        self::assertEquals('Description', $cc->getDescription());
    }
}
