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
use Modules\Kanban\Models\KanbanBoard;
use Modules\Kanban\Models\KanbanBoardMapper;
use phpOMS\Utils\RnG\Text;

/**
 * @internal
 */
class KanbanBoardMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $board = new KanbanBoard();

        $board->setName('Test Board 0');
        $board->setDescription('This is some description');
        $board->setCreatedBy(new NullAccount(1));

        $id = KanbanBoardMapper::create($board);
        self::assertGreaterThan(0, $board->getId());
        self::assertEquals($id, $board->getId());

        $boardR = KanbanBoardMapper::get($board->getId());
        self::assertEquals($board->getName(), $boardR->getName());
        self::assertEquals($board->getStatus(), $boardR->getStatus());
        self::assertEquals($board->getDescription(), $boardR->getDescription());
        self::assertEquals($board->getCreatedBy()->getId(), $boardR->getCreatedBy()->getId());
        self::assertEquals($board->getCreatedAt()->format('Y-m-d'), $boardR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($board->getColumns(), $boardR->getColumns());
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 30; ++$i) {
            $text  = new Text();
            $board = new KanbanBoard();

            $board->setName($text->generateText(\mt_rand(3, 7)));
            $board->setDescription($text->generateText(\mt_rand(20, 70)));
            $board->setCreatedBy(new NullAccount(1));

            $id = KanbanBoardMapper::create($board);
        }
    }
}
