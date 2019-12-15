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

namespace Modules\tests\Kanban\Models;

use Modules\Kanban\Models\KanbanColumn;
use Modules\Kanban\Models\KanbanColumnMapper;
use phpOMS\Utils\RnG\Text;

/**
 * @internal
 */
class KanbanColumnMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $column = new KanbanColumn();

        $column->setName('Some Column');
        $column->setBoard(1);
        $column->setOrder(1);

        $id = KanbanColumnMapper::create($column);
        self::assertGreaterThan(0, $column->getId());
        self::assertEquals($id, $column->getId());

        $columnR = KanbanColumnMapper::get($column->getId());
        self::assertEquals($column->getName(), $columnR->getName());
        self::assertEquals($column->getBoard(), $columnR->getBoard());
        self::assertEquals($column->getOrder(), $columnR->getOrder());
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 4; ++$i) {
            $text   = new Text();
            $column = new KanbanColumn();

            $column->setName($text->generateText(\mt_rand(3, 7)));
            $column->setBoard(1);
            $column->setOrder($i + 1);

            $id = KanbanColumnMapper::create($column);
        }
    }
}
