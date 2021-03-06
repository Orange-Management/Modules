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
use Modules\Tasks\Models\TaskElement;
use Modules\Tasks\Models\TaskPriority;
use Modules\Tasks\Models\TaskStatus;
use Modules\Tasks\Models\TaskType;

/**
 * @internal
 */
class TicketTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $ticket = new Ticket();

        self::assertEquals(0, $ticket->getId());
        self::assertInstanceOf('\Modules\Tasks\Models\Task', $ticket->getTask());
        self::assertEquals(TaskType::HIDDEN, $ticket->getTask()->getType());
    }

    public function testSetGet() : void
    {
        $ticket = new Ticket();

        $ticket->getTask()->setCreatedBy(new NullAccount(1));
        self::assertEquals(1, $ticket->getTask()->getCreatedBy()->getId());

        $ticket->getTask()->setTitle('Ticket');
        self::assertEquals('Ticket', $ticket->getTask()->getTitle());

        $ticket->getTask()->setDone($date = new \DateTime('2000-05-06'));
        self::assertEquals($date->format('Y-m-d'), $ticket->getTask()->getDone()->format('Y-m-d'));

        $ticket->getTask()->setDue($date = new \DateTime('2000-05-07'));
        self::assertEquals($date->format('Y-m-d'), $ticket->getTask()->getDue()->format('Y-m-d'));

        $ticket->getTask()->setStatus(TaskStatus::DONE);
        self::assertEquals(TaskStatus::DONE, $ticket->getTask()->getStatus());

        $ticket->getTask()->setPriority(TaskPriority::LOW);
        self::assertEquals(TaskPriority::LOW, $ticket->getTask()->getPriority());

        $id      = [];
        $id[]    = $ticket->getTask()->addElement(new TaskElement());
        $id[]    = $ticket->getTask()->addElement(new TaskElement());
        $success = $ticket->getTask()->removeElement(99);

        self::assertFalse($success);

        $success = $ticket->getTask()->removeElement($id[1]);
        self::assertTrue($success);

        self::assertEquals(0, $ticket->getTask()->getTaskElements()[0]->getId());
        self::assertEquals(0, $ticket->getTask()->getTaskElement(0)->getId());

        $ticket->getTask()->setDescription('Ticket Description');
        self::assertEquals('Ticket Description', $ticket->getTask()->getDescription());

        self::assertInstanceOf('\Modules\Tasks\Models\TaskElement', $ticket->getTask()->getTaskElement(1));
    }
}
