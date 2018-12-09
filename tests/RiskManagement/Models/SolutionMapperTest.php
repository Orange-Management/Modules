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

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Solution;
use Modules\RiskManagement\Models\SolutionMapper;

class SolutionMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD()
    {
        $obj = new Solution();

        $obj->setTitle('Title');
        $obj->setDescriptionRaw('Description');
        $obj->setProbability(1);
        $obj->setCause(1);
        $obj->setRisk(1);

        SolutionMapper::create($obj);

        $objR = SolutionMapper::get($obj->getId());
        self::assertEquals($obj->getTitle(), $objR->getTitle());
        self::assertEquals($obj->getDescriptionRaw(), $objR->getDescriptionRaw());
        self::assertEquals($obj->getProbability(), $objR->getProbability());
        self::assertEquals($obj->getRisk(), $objR->getRisk()->getId());
        self::assertEquals($obj->getCause(), $objR->getCause()->getId());
    }
}
