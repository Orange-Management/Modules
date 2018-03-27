<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\EventManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Event type enum.
 *
 * @package    Calendar
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class EventType extends Enum
{
    public const DEFAULT = 0;

    public const COURSE = 1;

    public const EVENT = 2;

    public const FAIR = 3;

    public const CONGRESS = 4;

    public const DEMO = 5;

    public const CONFERENCE = 6;

    public const SEMINAR = 7;

    public const MEETING = 8;

    public const TRADESHOW = 9;

    public const LAUNCH = 10;

    public const CELEBRATION = 11;
}
