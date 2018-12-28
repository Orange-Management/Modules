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

namespace Modules\tests\EventManagement\Models;

use Modules\EventManagement\Models\Event;
use Modules\EventManagement\Models\EventType;
use Modules\EventManagement\Models\ProgressType;
use Modules\Tasks\Models\Task;
use phpOMS\Localization\Money;

class EventTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult() : void
    {
        $event = new Event();

        self::assertEquals(0, $event->getId());
        self::assertEquals(EventType::DEFAULT, $event->getType());
        self::assertInstanceOf('\Modules\Calendar\Models\Calendar', $event->getCalendar());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $event->getStart()->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->modify('+1 month')->format('Y-m-d'), $event->getEnd()->format('Y-m-d'));
        self::assertEquals(0, $event->getCosts()->getInt());
        self::assertEquals(0, $event->getBudget()->getInt());
        self::assertEquals(0, $event->getEarnings()->getInt());
        self::assertFalse($event->removeTask(2));
        self::assertEmpty($event->getTasks());
        self::assertEquals(0, $event->getProgress());
        self::assertEquals(ProgressType::MANUAL, $event->getProgressType());
    }

    public function testSetGet() : void
    {
        $event = new Event();

        $event->setType(EventType::SEMINAR);
        self::assertEquals(EventType::SEMINAR, $event->getType());

        $money = new Money();
        $money->setString('1.23');

        $event->setCosts($money);
        self::assertEquals($money->getAmount(), $event->getCosts()->getAmount());

        $event->setBudget($money);
        self::assertEquals($money->getAmount(), $event->getBudget()->getAmount());

        $event->setEarnings($money);
        self::assertEquals($money->getAmount(), $event->getEarnings()->getAmount());

        $task = new Task();
        $task->setTitle('A');

        $event->addTask($task);
        self::assertEquals('A', $event->getTask(0)->getTitle());

        self::assertTrue($event->removeTask(0));
        self::assertEquals(0, $event->countTasks());

        $event->addTask($task);
        self::assertEquals(1, count($event->getTasks()));

        $event->setProgress(10);
        self::assertEquals(10, $event->getProgress());

        $event->setProgressType(ProgressType::TASKS);
        self::assertEquals(ProgressType::TASKS, $event->getProgressType());
    }
}
