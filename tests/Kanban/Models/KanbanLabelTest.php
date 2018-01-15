<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\Kanban\Models;

use Modules\Kanban\Models\KanbanLabel;

class KanbanLabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $label = new KanbanLabel();

        self::assertEquals(0, $label->getId());
        self::assertEquals('', $label->getName());
        self::assertEquals(0, $label->getColor());
        self::assertEquals(0, $label->getBoard());
    }

    public function testSetGet()
    {
        $label = new KanbanLabel();

        $label->setName('Label');
        $label->setColor(10);
        $label->setBoard(12);

        self::assertEquals('Label', $label->getName());
        self::assertEquals(10, $label->getColor());
        self::assertEquals(12, $label->getBoard());
    }
}
