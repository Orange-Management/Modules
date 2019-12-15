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
use Modules\RiskManagement\Models\RiskObjectMapper;

/**
 * @internal
 */
class RiskObjectMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $obj = new RiskObject();
        $obj->setTitle('Name');
        $obj->setDescriptionRaw('Description');
        $obj->setRisk(1);

        RiskObjectMapper::create($obj);

        $objR = RiskObjectMapper::get($obj->getId());
        self::assertEquals($obj->getTitle(), $objR->getTitle());
        self::assertEquals($obj->getDescriptionRaw(), $objR->getDescriptionRaw());
        self::assertEquals($obj->getRisk(), $objR->getRisk());
    }
}
