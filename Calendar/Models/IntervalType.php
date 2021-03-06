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
 * Interval type type enum.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class IntervalType extends Enum
{
    public const ABSOLUTE = 1;

    public const RELATIVE = 2;
}
