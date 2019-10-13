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

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\RiskObject;

/**
 * @internal
 */
class RiskObjectTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $obj = new RiskObject();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->getTitle());
        self::assertEquals('', $obj->getDescription());
        self::assertEquals('', $obj->getDescriptionRaw());
        self::assertEquals(0, $obj->getRisk());
    }

    public function testSetGet() : void
    {
        $obj = new RiskObject();

        $obj->setTitle('Name');
        self::assertEquals('Name', $obj->getTitle());

        $obj->setDescriptionRaw('Description');
        self::assertEquals('Description', $obj->getDescriptionRaw());

        $obj->setRisk(1);
        self::assertEquals(1, $obj->getRisk());
    }
}
