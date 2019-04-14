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

use Modules\Tasks\Models\Task;
use Modules\Tasks\Models\TaskElement;
use Modules\Tasks\Models\TaskPriority;
use Modules\Tasks\Models\TaskStatus;
use Modules\Tasks\Models\TaskType;

class TaskTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult() : void
    {
        $task = new Task();

        self::assertEquals(0, $task->getId());
        self::assertEquals(0, $task->getCreatedBy());
        self::assertEquals('', $task->getTitle());
        self::assertFalse($task->isToAccount(0));
        self::assertFalse($task->isCCAccount(0));
        self::assertFalse($task->isToGroup(0));
        self::assertFalse($task->isCCGroup(0));
        self::assertTrue($task->isEditable());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $task->getCreatedAt()->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $task->getStart()->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $task->getDone()->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->modify('+1 day')->format('Y-m-d'), $task->getDue()->format('Y-m-d'));
        self::assertEquals(TaskStatus::OPEN, $task->getStatus());
        self::assertTrue($task->isClosable());
        self::assertEquals(TaskPriority::NONE, $task->getPriority());
        self::assertEquals(TaskType::SINGLE, $task->getType());
        self::assertEquals([], $task->getTaskElements());
        self::assertEquals('', $task->getDescription());
        self::assertEquals('', $task->getDescriptionRaw());
        self::assertInstanceOf('\Modules\Tasks\Models\NullTaskElement', $task->getTaskElement(1));
    }

    public function testSetGet() : void
    {
        $task = new Task();

        $task->setCreatedBy(1);
        self::assertEquals(1, $task->getCreatedBy());

        $task->setStart($date = new \DateTime('2005-05-05'));
        self::assertEquals($date->format('Y-m-d'), $task->getStart()->format('Y-m-d'));

        $task->setTitle('Title');
        self::assertEquals('Title', $task->getTitle());

        $task->setDone($date = new \DateTime('2000-05-06'));
        self::assertEquals($date->format('Y-m-d'), $task->getDone()->format('Y-m-d'));

        $task->setDue($date = new \DateTime('2000-05-07'));
        self::assertEquals($date->format('Y-m-d'), $task->getDue()->format('Y-m-d'));

        $task->setStatus(TaskStatus::DONE);
        self::assertEquals(TaskStatus::DONE, $task->getStatus());

        $task->setClosable(false);
        self::assertFalse($task->isClosable());

        $task->setPriority(TaskPriority::LOW);
        self::assertEquals(TaskPriority::LOW, $task->getPriority());

        $taskElement1 = new TaskElement();
        $taskElement1->addTo(2);
        $taskElement1->addGroupTo(4);
        $taskElement1->addCC(6);
        $taskElement1->addGroupCC(8);

        $taskElement2 = new TaskElement();
        $taskElement2->addTo(3);
        $taskElement2->addGroupTo(5);
        $taskElement2->addCC(7);
        $taskElement2->addGroupCC(9);

        $id   = [];
        $id[] = $task->addElement($taskElement1);
        $id[] = $task->addElement($taskElement2);

        self::assertTrue($task->isToAccount(2));
        self::assertTrue($task->isToAccount(3));
        self::assertTrue($task->isToGroup(4));
        self::assertTrue($task->isToGroup(5));

        self::assertTrue($task->isCCAccount(6));
        self::assertTrue($task->isCCAccount(7));
        self::assertTrue($task->isCCGroup(8));
        self::assertTrue($task->isCCGroup(9));

        $success = $task->removeElement(99);
        self::assertFalse($success);

        $success = $task->removeElement($id[1]);
        self::assertTrue($success);

        self::assertEquals(0, $task->getTaskElements()[0]->getId());
        self::assertEquals(0, $task->getTaskElement(0)->getId());

        $task->setDescription('Description');
        self::assertEquals('Description', $task->getDescription());

        $task->setDescriptionRaw('DescriptionRaw');
        self::assertEquals('DescriptionRaw', $task->getDescriptionRaw());

        $task->setEditable(false);
        self::assertFalse($task->isEditable());

        self::assertInstanceOf('\Modules\Tasks\Models\TaskElement', $task->getTaskElement(1));

        $arr = [
            'id' => 0,
            'createdBy' => $task->getCreatedBy(),
            'createdAt' => $task->getCreatedAt()->format('Y-m-d H:i:s'),
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'status' => $task->getStatus(),
            'type' => $task->getType(),
            'priority' => $task->getPriority(),
            'due' => $task->getDue()->format('Y-m-d H:i:s'),
            'done' => $task->getDone()->format('Y-m-d H:i:s'),
        ];
        self::assertArraySubset($arr, $task->toArray());
        self::assertArraySubset($arr, $task->jsonSerialize());
    }

    public function testInvalidStatus() : void
    {
        self::expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);

        $task = new Task();
        $task->setStatus(9999);
    }

    public function testInvalidPriority() : void
    {
        self::expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);

        $task = new Task();
        $task->setPriority(9999);
    }
}
