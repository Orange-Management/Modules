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

namespace Modules\tests\Tasks\Models;

use Modules\Tasks\Models\TaskElement;
use Modules\Tasks\Models\TaskStatus;

final class TaskElementTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $task = new TaskElement();

        self::assertEquals(0, $task->getId());
        self::assertEquals(0, $task->getCreatedBy());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $task->getCreatedAt()->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->modify('+1 day')->format('Y-m-d'), $task->getDue()->format('Y-m-d'));
        self::assertEquals(TaskStatus::OPEN, $task->getStatus());
        self::assertEquals('', $task->getDescription());
        self::assertEquals('', $task->getDescriptionRaw());
        self::assertEquals(0, $task->getForwarded());
        self::assertEquals(0, $task->getTask());
    }

    public function testSetGet()
    {
        $task = new TaskElement();

        $task->setCreatedBy(1);
        self::assertEquals(1, $task->getCreatedBy());

        $task->setDue($date = new \DateTime('2000-05-07'));
        self::assertEquals($date->format('Y-m-d'), $task->getDue()->format('Y-m-d'));

        $task->setStatus(TaskStatus::DONE);
        self::assertEquals(TaskStatus::DONE, $task->getStatus());

        $task->setDescription('Description');
        self::assertEquals('Description', $task->getDescription());

        $task->setDescriptionRaw('DescriptionRaw');
        self::assertEquals('DescriptionRaw', $task->getDescriptionRaw());

        $task->setTask(2);
        self::assertEquals(2, $task->getTask());

        $task->setForwarded(3);
        self::assertEquals(3, $task->getForwarded());
    }

    /**
     * @expectedException \phpOMS\Stdlib\Base\Exception\InvalidEnumValue
     */
    public function testInvalidStatus()
    {
        $task = new TaskElement();
        $task->setStatus(9999);
    }
}
