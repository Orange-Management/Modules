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


namespace Modules\tests\Organization\Models;

use Modules\Organization\Models\Unit;
use Modules\Organization\Models\UnitMapper;

/**
 * @internal
 */
class UnitMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $unit = new Unit();
        $unit->setName('Scrooge Inc.');
        $unit->setDescription('Description');
        $unit->setParent(1);

        $id = UnitMapper::create($unit);

        $unitR = UnitMapper::get($id);
        self::assertEquals($id, $unitR->getId());
        self::assertEquals($unit->getName(), $unitR->getName());
        self::assertEquals($unit->getDescription(), $unitR->getDescription());
        self::assertEquals($unit->getParent(), $unitR->getParent()->getId());
    }
}
