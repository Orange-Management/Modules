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

namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\CostCenter;

class CostCenterTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $cc = new CostCenter();
        self::assertEquals(0, $cc->getId());
        self::assertEquals('', $cc->getName());
        self::assertEquals('', $cc->getDescription());
    }

    public function testSetGet()
    {
        $cc = new CostCenter();

        $cc->setName('Name');
        self::assertEquals('Name', $cc->getName());

        $cc->setDescription('Description');
        self::assertEquals('Description', $cc->getDescription());
    }
}
