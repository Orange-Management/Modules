<?php declare(strict_types=1);
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

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Process;
use Modules\RiskManagement\Models\ProcessMapper;

/**
 * @internal
 */
class ProcessMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $obj = new Process();
        $obj->setTitle('Name');
        $obj->setDescriptionRaw('Description');
        $obj->setDepartment(1);
        $obj->setResponsible(1);
        $obj->setDeputy(1);
        $obj->setUnit(1);

        ProcessMapper::create($obj);

        $objR = ProcessMapper::get($obj->getId());
        self::assertEquals($obj->getTitle(), $objR->getTitle());
        self::assertEquals($obj->getDescriptionRaw(), $objR->getDescriptionRaw());
        self::assertEquals($obj->getResponsible(), $objR->getResponsible());
        self::assertEquals($obj->getDeputy(), $objR->getDeputy());
        self::assertEquals($obj->getDepartment(), $objR->getDepartment()->getId());
        self::assertEquals($obj->getUnit(), $objR->getUnit()->getId());
    }
}
