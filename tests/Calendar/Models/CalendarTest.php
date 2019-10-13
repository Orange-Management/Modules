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

namespace Modules\tests\Calendar\Models;

use Modules\Calendar\Models\Calendar;
use Modules\Calendar\Models\Event;

/**
 * @internal
 */
class CalendarTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $calendar = new Calendar();

        self::assertEquals(0, $calendar->getId());
        self::assertEquals('', $calendar->getName());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $calendar->getCreatedAt()->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $calendar->getDate()->format('Y-m-d'));
        self::assertEquals('', $calendar->getDescription());
        self::assertEquals([], $calendar->getEvents());
        self::assertInstanceOf('\Modules\Calendar\Models\NullEvent', $calendar->getEvent(0));
        self::assertFalse($calendar->hasEventOnDate(new \DateTime('now')));
        self::assertEquals([], $calendar->getEventByDate(new \DateTime('now')));
    }

    public function testSetGet() : void
    {
        $calendar = new Calendar();

        $calendar->setDate($date = new \DateTime('2000-05-05'));
        self::assertEquals($date->format('Y-m-d'), $calendar->getDate()->format('Y-m-d'));

        $calendar->setName('Title');
        self::assertEquals('Title', $calendar->getName());

        $calendar->setDescription('Description');
        self::assertEquals('Description', $calendar->getDescription());

        $id      = [];
        $id[]    = $calendar->addEvent(new Event());
        $id[]    = $calendar->addEvent(new Event());
        $success = $calendar->removeEvent(99);

        self::assertFalse($success);

        $success = $calendar->removeEvent($id[1]);
        self::assertTrue($success);

        self::assertEquals(0, $calendar->getEvents()[0]->getId());
        self::assertEquals(0, $calendar->getEvent(0)->getId());

        self::assertInstanceOf('\Modules\Calendar\Models\Event', $calendar->getEvent(1));
    }
}
