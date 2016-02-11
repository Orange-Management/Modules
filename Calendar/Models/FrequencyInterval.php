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
namespace Modules\Calendar\Models;

use phpOMS\Datatypes\Enum;

/**
 * Occurrence type enum.
 *
 * @category   OccurrenceType
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class FrequencyInterval extends Enum
{
    const SUNDAY     = 1;
    const MONDAY     = 2;
    const TUESDAY    = 4;
    const WEDNESDAY  = 8;
    const THURSDAY   = 16;
    const FRIDAY     = 32;
    const SATURDAY   = 64;
    const DAY        = 128;
    const WEEKDAY    = 256;
    const WEEKENDDAY = 512;
}
