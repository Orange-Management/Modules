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
use Modules\HumanResourceTimeRecording\Models\SessionMapper;
use Modules\HumanResourceTimeRecording\Models\SessionElement;

/**
 * @internal
 */
class SessionMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\HumanResourceTimeRecording\Models\SessionMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $session = new Session(1);

        $dt = new \DateTime(\date('Y-m-d', \strtotime('now')) . ' 7:55:34');
        $element = new SessionElement($session, $dt);
        $element->setStatus(ClockingStatus::START);
        $session->addSessionElement($element);

        $id = SessionMapper::create($session);
        self::assertGreaterThan(0, $session->getId());
        self::assertEquals($id, $session->getId());

        $sessionR = SessionMapper::get($session->getId());
        self::assertEquals($session->getType(), $sessionR->getType());
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 0; $i < 1000; ++$i) {
            $day     = \date('Y-m-d', \strtotime(' -' . ($i + 1) . ' day'));
            $weekday = \date('D', \strtotime($day));

            if ($weekday === 'Sat' || $weekday === 'Sun') {
                continue;
            }

            $session = new Session(1);

            $hourStart    = \mt_rand(7, 9);
            $minutesStart = \mt_rand(0, 59);

            $hourEnd    = \mt_rand(16, 18);
            $minutesEnd = \mt_rand(0, 59);

            $hourBreakStart    = \mt_rand(11, 14);
            $minutesBreakStart = \mt_rand(0, 59);

            $breakLength = \mt_rand(5, 90);

            // start
            $dt      = new \DateTime($day . ' ' . $hourStart . ':' . $minutesStart);
            $element = new SessionElement($session, $dt);
            $element->setStatus(ClockingStatus::START);
            $session->addSessionElement($element);

            // break start
            $dt      = new \DateTime($day . ' ' . $hourBreakStart . ':' . $minutesBreakStart);
            $element = new SessionElement($session, $dt);
            $element->setStatus(ClockingStatus::PAUSE);
            $session->addSessionElement($element);

            // work continue
            $dt      = new \DateTime($day . ' ' . ($hourBreakStart + ((int) (($minutesBreakStart + $breakLength) / 60))) . ':' . (($minutesBreakStart + $breakLength) % 60));
            $element = new SessionElement($session, $dt);
            $element->setStatus(ClockingStatus::CONTINUE);
            $session->addSessionElement($element);

            // end
            $dt      = new \DateTime($day . ' ' . $hourEnd . ':' . $minutesEnd);
            $element = new SessionElement($session, $dt);
            $element->setStatus(ClockingStatus::END);
            $session->addSessionElement($element);

            SessionMapper::create($session);
        }
    }
}
