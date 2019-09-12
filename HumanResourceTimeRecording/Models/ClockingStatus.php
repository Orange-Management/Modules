<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\HumanResourceTimeRecording
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\HumanResourceTimeRecording\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * ClockingStatus enum.
 *
 * @package Modules\HumanResourceTimeRecording
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class ClockingStatus extends Enum
{
    public const START = 1;
    public const PAUSE = 2;
    public const ON_THE_MOVE = 3;
    public const END   = 4;
}
