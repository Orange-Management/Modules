<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\EventManagement\Models;

use phpOMS\Datatypes\Enum;

/**
 * Event type enum.
 *
 * @category   Calendar
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class EventType extends Enum
{
    const DEFAULT = 0;

    const COURSE = 1;

    const EVENT = 2;

    const FAIR = 3;

    const CONGRESS = 4;

    const DEMO = 5;

    const CONFERENCE = 6;

    const SEMINAR = 7;

    const MEETING = 8;

    const TRADESHOW = 9;

    const LAUNCH = 10;

    const CELEBRATION = 11;
}
