<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Calendar\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Frequency interval type enum.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class FrequencyInterval extends Enum
{
    public const SUNDAY     = 1;
    public const MONDAY     = 2;
    public const TUESDAY    = 4;
    public const WEDNESDAY  = 8;
    public const THURSDAY   = 16;
    public const FRIDAY     = 32;
    public const SATURDAY   = 64;
    public const DAY        = 128;
    public const WEEKDAY    = 256;
    public const WEEKENDDAY = 512;
}
