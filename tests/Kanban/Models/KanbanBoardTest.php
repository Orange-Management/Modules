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

namespace Modules\tests\Kanban\Models;

use Modules\Kanban\Models\KanbanBoard;
use Modules\Kanban\Models\BoardStatus;

final class KanbanBoardTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $board = new KanbanBoard();

        self::assertEquals(0, $board->getId());
        self::assertEquals(BoardStatus::ACTIVE, $board->getStatus());
        self::assertEquals('', $board->getName());
        self::assertEquals('', $board->getDescription());
        self::assertEquals(0, $board->getCreatedBy());
        self::assertInstanceOf('\DateTime', $board->getCreatedAt());
        self::assertEquals([], $board->getColumns());
    }

    public function testSetGet()
    {
        $board = new KanbanBoard();

        $board->setName('Name');
        $board->setDescription('Description');
        $board->setStatus(BoardStatus::ARCHIVED);
        $board->setCreatedBy(1);
        $board->addColumn(2);

        self::assertEquals(BoardStatus::ARCHIVED, $board->getStatus());
        self::assertEquals('Name', $board->getName());
        self::assertEquals('Description', $board->getDescription());
        self::assertEquals(1, $board->getCreatedBy());
        self::assertEquals([2], $board->getColumns());
    }
}
