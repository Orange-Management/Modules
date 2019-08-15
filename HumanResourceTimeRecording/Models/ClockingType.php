<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\HumanResourceTimeRecording
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\HumanResourceTimeRecording\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * ClockingType enum.
 *
 * @package    Modules\HumanResourceTimeRecording
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class ClockingType extends Enum
{
    public const OFFICE   = 1;
    public const HOME     = 2;
    public const REMOTE   = 3;
    public const VACATION = 4;
    public const SICK     = 5;
}
