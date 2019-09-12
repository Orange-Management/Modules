<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Marketing\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Marketing\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Task type enum.
 *
 * @package Modules\Marketing\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class ProgressType extends Enum
{
    public const MANUAL      = 0;
    public const LINEAR      = 1;
    public const EXPONENTIAL = 2;
    public const LOG         = 3;
    public const TASKS       = 4;
}
