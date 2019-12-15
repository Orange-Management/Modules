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

use Modules\RiskManagement\Models\Solution;
use Modules\RiskManagement\Models\SolutionMapper;

/**
 * @internal
 */
class SolutionMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
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
