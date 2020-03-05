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

use Modules\Admin\Models\NullAccount;
use Modules\Kanban\Models\BoardStatus;
use Modules\Kanban\Models\KanbanBoard;

/**
 * @internal
 */
class KanbanBoardTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $board = new KanbanBoard();

        self::assertEquals(0, $board->getId());
        self::assertEquals(BoardStatus::ACTIVE, $board->getStatus());
        self::assertEquals('', $board->getName());
        self::assertEquals('', $board->getDescription());
        self::assertEquals(0, $board->getCreatedBy()->getId());
        self::assertInstanceOf('\DateTime', $board->getCreatedAt());
        self::assertEquals([], $board->getColumns());
    }

    public function testSetGet() : void
    {
        $board = new KanbanBoard();

        $board->setName('Name');
        $board->setDescription('Description');
        $board->setStatus(BoardStatus::ARCHIVED);
        $board->setCreatedBy(new NullAccount(1));
        $board->addColumn(2);

        self::assertEquals(BoardStatus::ARCHIVED, $board->getStatus());
        self::assertEquals('Name', $board->getName());
        self::assertEquals('Description', $board->getDescription());
        self::assertEquals(1, $board->getCreatedBy()->getId());
        self::assertEquals([2], $board->getColumns());
    }
}
