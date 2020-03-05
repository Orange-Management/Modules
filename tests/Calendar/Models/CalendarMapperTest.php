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

use Modules\Admin\Models\NullAccount;
use Modules\Calendar\Models\Calendar;
use Modules\Calendar\Models\CalendarMapper;
use Modules\Calendar\Models\Event;

/**
 * @internal
 */
class CalendarMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $calendar = new Calendar();

        $calendar->setName('Title');
        $calendar->setDescription('Description');

        $calendarEvent1 = new Event();
        $calendarEvent1->setName('Running test');
        $calendarEvent1->setDescription('Desc1');
        $calendarEvent1->setCreatedBy(new NullAccount(1));
        $calendarEvent1->getSchedule()->setCreatedBy(new NullAccount(1));
        $calendar->addEvent($calendarEvent1);

        $calendarEvent2 = new Event();
        $calendarEvent2->setName('Running test2');
        $calendarEvent2->setDescription('Desc2');
        $calendarEvent2->setCreatedBy(new NullAccount(1));
        $calendarEvent2->getSchedule()->setCreatedBy(new NullAccount(1));
        $calendar->addEvent($calendarEvent2);

        $id = CalendarMapper::create($calendar);
        self::assertGreaterThan(0, $calendar->getId());
        self::assertEquals($id, $calendar->getId());

        $calendarR = CalendarMapper::get($calendar->getId());
        self::assertEquals($calendar->getCreatedAt()->format('Y-m-d'), $calendarR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($calendar->getDescription(), $calendarR->getDescription());
        self::assertEquals($calendar->getName(), $calendarR->getName());

        $expected = $calendar->getEvents();
        $actual   = $calendarR->getEvents();

        self::assertEquals(\end($expected)->getDescription(), \end($actual)->getDescription());
    }
}
