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

namespace Modules\tests\HumanResourceTimeRecording\Models;

use Modules\HumanResourceTimeRecording\Models\ClockingStatus;
use Modules\HumanResourceTimeRecording\Models\Session;
use Modules\HumanResourceTimeRecording\Models\ClockingType;
use Modules\HumanResourceTimeRecording\Models\SessionElement;

/**
 * @internal
 */
class SessionTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $session = new Session();

        self::assertEquals(0, $session->getId());
        self::assertEquals(0, $session->getBusy());
        self::assertEquals(ClockingType::OFFICE, $session->getType());
        self::assertEquals(ClockingStatus::START, $session->getStatus());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $session->getStart()->format('Y-m-d'));
        self::assertEquals(null, $session->getEnd());
    }

    public function testSetGet() : void
    {
        $session = new Session();

        $session->setType(ClockingType::VACATION);
        self::assertEquals(ClockingType::VACATION, $session->getType());

        $element = new SessionElement(0, new \DateTime('now'));
        $element->setStatus(ClockingStatus::PAUSE);
        $session->addSessionElement($element);

        self::assertEquals(ClockingStatus::PAUSE, $session->getStatus());
    }
}
