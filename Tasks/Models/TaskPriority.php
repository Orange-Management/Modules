<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Tasks
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tasks\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Task priority enum.
 *
 * @package    Modules\Tasks
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class TaskPriority extends Enum
{
    public const NONE   = 0;
    public const VLOW   = 1;
    public const LOW    = 2;
    public const MEDIUM = 3;
    public const HIGH   = 4;
    public const VHIGH  = 5;
}
