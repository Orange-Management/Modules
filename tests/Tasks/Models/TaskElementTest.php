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


namespace Modules\tests\Tasks\Models;

use Modules\Tasks\Models\TaskElement;
use Modules\Tasks\Models\TaskPriority;
use Modules\Tasks\Models\TaskStatus;

/**
 * @internal
 */
class TaskElementTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $task = new TaskElement();

        self::assertEquals(0, $task->getId());
        self::assertEquals(0, $task->getCreatedBy());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $task->getCreatedAt()->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->modify('+1 day')->format('Y-m-d'), $task->getDue()->format('Y-m-d'));
        self::assertEquals(TaskStatus::OPEN, $task->getStatus());
        self::assertEquals('', $task->getDescription());
        self::assertEquals('', $task->getDescriptionRaw());
        self::assertEquals([], $task->getTo());
        self::assertEquals([], $task->getCC());
        self::assertEquals(0, $task->getTask());
        self::assertEquals(TaskPriority::NONE, $task->getPriority());
    }

    public function testSetGet() : void
    {
        $task = new TaskElement();

        $task->setCreatedBy(1);
        self::assertEquals(1, $task->getCreatedBy());

        $task->setDue($date = new \DateTime('2000-05-07'));
        self::assertEquals($date->format('Y-m-d'), $task->getDue()->format('Y-m-d'));

        $task->setStatus(TaskStatus::DONE);
        self::assertEquals(TaskStatus::DONE, $task->getStatus());

        $task->setPriority(TaskPriority::MEDIUM);
        self::assertEquals(TaskPriority::MEDIUM, $task->getPriority());

        $task->setDescription('Description');
        self::assertEquals('Description', $task->getDescription());

        $task->setDescriptionRaw('DescriptionRaw');
        self::assertEquals('DescriptionRaw', $task->getDescriptionRaw());

        $task->setTask(2);
        self::assertEquals(2, $task->getTask());

        $task->addTo(3);
        $task->addTo(3); // test duplicate
        self::assertTrue($task->isToAccount(3));

        $task->addGroupTo(4);
        $task->addGroupTo(4); // test duplicate
        self::assertTrue($task->isToGroup(4));

        $task->addCC(5);
        $task->addCC(5); // test duplicate
        self::assertTrue($task->isCCAccount(5));

        $task->addGroupCC(6);
        $task->addGroupCC(6); // test duplicate
        self::assertTrue($task->isCCGroup(6));

        self::assertFalse($task->isToAccount(7));
        self::assertFalse($task->isCCAccount(8));
        self::assertFalse($task->isToGroup(9));
        self::assertFalse($task->isCCGroup(10));
    }

    public function testInvalidStatus() : void
    {
        self::expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);

        $task = new TaskElement();
        $task->setStatus(9999);
    }

    public function testInvalidPriority() : void
    {
        self::expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);

        $task = new TaskElement();
        $task->setPriority(9999);
    }
}
