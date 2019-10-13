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

use Modules\HumanResourceTimeRecording\Models\SessionElement;
use Modules\HumanResourceTimeRecording\Models\ClockingStatus;

/**
 * @internal
 */
class SessionElementTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $element = new SessionElement();

        self::assertEquals(0, $element->getId());
        self::assertEquals(0, $element->getSession());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $element->getDatetime()->format('Y-m-d'));
        self::assertEquals(ClockingStatus::START, $element->getStatus());
    }

    public function testSetGet() : void
    {
        $element = new SessionElement();

        $element->setStatus(ClockingStatus::END);
        self::assertEquals(ClockingStatus::END, $element->getStatus());
    }
}
