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
use Modules\Calendar\Models\Event;
use Modules\Calendar\Models\EventMapper;

/**
 * @internal
 */
class EventMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $calendarEvent1 = new Event();

        $calendarEvent1->setName('Running test');
        $calendarEvent1->setDescription('Desc1');
        $calendarEvent1->setCreatedBy(new NullAccount(1));
        $calendarEvent1->getSchedule()->setCreatedBy(new NullAccount(1));
        $calendarEvent1->setCalendar(1);

        $id = EventMapper::create($calendarEvent1);
        self::assertGreaterThan(0, $calendarEvent1->getId());
        self::assertEquals($id, $calendarEvent1->getId());

        $eventR = EventMapper::get($calendarEvent1->getId());
        self::assertEquals($calendarEvent1->getCreatedBy()->getId(), $eventR->getCreatedBy()->getId());
        self::assertEquals($calendarEvent1->getDescription(), $eventR->getDescription());
    }
}
