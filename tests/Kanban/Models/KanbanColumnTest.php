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

use Modules\Kanban\Models\KanbanCard;
use Modules\Kanban\Models\KanbanColumn;

/**
 * @internal
 */
class KanbanColumnTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $column = new KanbanColumn();

        self::assertEquals(0, $column->getId());
        self::assertEquals('', $column->getName());
        self::assertEquals(0, $column->getOrder());
        self::assertEquals(0, $column->getBoard());
        self::assertEquals([], $column->getCards());
    }

    public function testSetGet() : void
    {
        $column = new KanbanColumn();

        $column->setName('Name');
        $column->setOrder(2);
        $column->setBoard(3);
        $column->addCard(new KanbanCard());

        self::assertEquals('Name', $column->getName());
        self::assertEquals(2, $column->getOrder());
        self::assertEquals(3, $column->getBoard());
    }
}
