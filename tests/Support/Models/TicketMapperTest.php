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

namespace Modules\tests\Support\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Support\Models\Ticket;
use Modules\Support\Models\TicketMapper;
use Modules\Tasks\Models\TaskElement;
use Modules\Tasks\Models\TaskPriority;
use Modules\Tasks\Models\TaskStatus;
use Modules\Tasks\Models\TaskType;
use phpOMS\Utils\RnG\Text;

/**
 * @internal
 */
class TicketMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $ticket = new Ticket();

        $ticket->getTask()->setCreatedBy(new NullAccount(1));
        $ticket->getTask()->getSchedule()->setCreatedBy(new NullAccount(1));
        $ticket->getTask()->setTitle('Ticket Title');
        $ticket->getTask()->setStatus(TaskStatus::DONE);
        $ticket->getTask()->setType(TaskType::HIDDEN);
        $ticket->getTask()->setPriority(TaskPriority::HIGH);
        $ticket->getTask()->setDescription('Ticket Description');
        $ticket->getTask()->setDone(new \DateTime('2000-05-06'));
        $ticket->getTask()->setDue(new \DateTime('2000-05-05'));

        $taskElement1 = new TaskElement();
        $taskElement1->setDescription('Desc1');
        $taskElement1->setCreatedBy(new NullAccount(1));
        $ticket->getTask()->addElement($taskElement1);

        $taskElement2 = new TaskElement();
        $taskElement2->setDescription('Desc2');
        $taskElement2->setCreatedBy(new NullAccount(1));
        $ticket->getTask()->addElement($taskElement2);

        $id = TicketMapper::create($ticket);
        self::assertGreaterThan(0, $ticket->getId());
        self::assertEquals($id, $ticket->getId());

        $ticketR = TicketMapper::get($ticket->getId());
        self::assertEquals($ticket->getTask()->getCreatedAt()->format('Y-m-d'), $ticketR->getTask()->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($ticket->getTask()->getCreatedBy()->getId(), $ticketR->getTask()->getCreatedBy()->getId());
        self::assertEquals($ticket->getTask()->getDescription(), $ticketR->getTask()->getDescription());
        self::assertEquals($ticket->getTask()->getTitle(), $ticketR->getTask()->getTitle());
        self::assertEquals($ticket->getTask()->getStatus(), $ticketR->getTask()->getStatus());
        self::assertEquals($ticket->getTask()->getType(), $ticketR->getTask()->getType());
        self::assertEquals($ticket->getTask()->getDone()->format('Y-m-d'), $ticketR->getTask()->getDone()->format('Y-m-d'));
        self::assertEquals($ticket->getTask()->getDue()->format('Y-m-d'), $ticketR->getTask()->getDue()->format('Y-m-d'));

        $expected = $ticket->getTask()->getTaskElements();
        $actual   = $ticketR->getTask()->getTaskElements();
        self::assertEquals(\end($expected)->getDescription(), \end($actual)->getDescription());
    }

    public function testNewest() : void
    {
        $newest = TicketMapper::getNewest(1);

        self::assertCount(1, $newest);
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testCreatedByMeForMe() : void
    {
        $text = new Text();

        $taskStatus = TaskStatus::getConstants();

        foreach ($taskStatus as $status) {
            $ticket = new Ticket();

            $ticket->getTask()->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->getSchedule()->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->setTitle($text->generateText(\mt_rand(1, 5)));
            $ticket->getTask()->setStatus($status);
            $ticket->getTask()->setType(TaskType::HIDDEN);
            $ticket->getTask()->setDescription($text->generateText(\mt_rand(10, 30)));
            $ticket->getTask()->setDone(new \DateTime('2000-05-06'));
            $ticket->getTask()->setDue(new \DateTime('2000-05-05'));

            $taskElement1 = new TaskElement();
            $taskElement1->setDescription($text->generateText(\mt_rand(3, 20)));
            $taskElement1->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->addElement($taskElement1);

            $taskElement2 = new TaskElement();
            $taskElement2->setDescription('Desc2');
            $taskElement2->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->addElement($taskElement2);

            $id = TicketMapper::create($ticket);
        }
    }

    /**
     * @group volume
     * @group module
     */
    public function testCreatedByMeForOther() : void
    {
        $text = new Text();

        $taskStatus = TaskStatus::getConstants();

        foreach ($taskStatus as $status) {
            $ticket = new Ticket();

            $ticket->getTask()->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->getSchedule()->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->setTitle($text->generateText(\mt_rand(1, 5)));
            $ticket->getTask()->setStatus($status);
            $ticket->getTask()->setType(TaskType::HIDDEN);
            $ticket->getTask()->setDescription($text->generateText(\mt_rand(10, 30)));
            $ticket->getTask()->setDone(new \DateTime('2000-05-06'));
            $ticket->getTask()->setDue(new \DateTime('2000-05-05'));

            $taskElement1 = new TaskElement();
            $taskElement1->setDescription($text->generateText(\mt_rand(3, 20)));
            $taskElement1->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->addElement($taskElement1);

            $taskElement2 = new TaskElement();
            $taskElement2->setDescription($text->generateText(\mt_rand(3, 20)));
            $taskElement2->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->addElement($taskElement2);

            $id = TicketMapper::create($ticket);
        }
    }

    /**
     * @group volume
     * @group module
     */
    public function testCreatedByOtherForMe() : void
    {
        $text = new Text();

        $taskStatus = TaskStatus::getConstants();

        foreach ($taskStatus as $status) {
            $ticket = new Ticket();

            $ticket->getTask()->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->getSchedule()->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->setTitle($text->generateText(\mt_rand(1, 5)));
            $ticket->getTask()->setStatus($status);
            $ticket->getTask()->setType(TaskType::HIDDEN);
            $ticket->getTask()->setDescription($text->generateText(\mt_rand(10, 30)));
            $ticket->getTask()->setDone(new \DateTime('2000-05-06'));
            $ticket->getTask()->setDue(new \DateTime('2000-05-05'));

            $taskElement1 = new TaskElement();
            $taskElement1->setDescription($text->generateText(\mt_rand(3, 20)));
            $taskElement1->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->addElement($taskElement1);

            $taskElement2 = new TaskElement();
            $taskElement2->setDescription($text->generateText(\mt_rand(3, 20)));
            $taskElement2->setCreatedBy(new NullAccount(1));
            $ticket->getTask()->addElement($taskElement2);

            $id = TicketMapper::create($ticket);
        }
    }
}
