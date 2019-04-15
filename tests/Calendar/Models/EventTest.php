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

namespace Modules\tests\Calendar\Models;

use Modules\Calendar\Models\Event;
use phpOMS\Account\Account;

class EventTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $event = new Event();

        self::assertEquals(0, $event->getId());
        self::assertEquals(0, $event->getCreatedBy());
        self::assertEquals('', $event->getName());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $event->getCreatedAt()->format('Y-m-d'));
        self::assertEquals('', $event->getDescription());
        self::assertEquals([], $event->getPeople());
        self::assertInstanceOf('\phpOMS\Account\NullAccount', $event->getPerson(1));
        self::assertInstanceOf('\phpOMS\Stdlib\Base\Location', $event->getLocation());
    }

    public function testSetGet() : void
    {
        $event = new Event();

        $event->setCreatedBy(1);
        self::assertEquals(1, $event->getCreatedBy());

        $event->setName('Name');
        self::assertEquals('Name', $event->getName());

        $event->setDescription('Description');
        self::assertEquals('Description', $event->getDescription());

        $event->addPerson(new Account());
        $event->addPerson(new Account());
        $success = $event->removePerson(99);

        self::assertFalse($success);

        $success = $event->removePerson(0);
        self::assertTrue($success);
    }
}
