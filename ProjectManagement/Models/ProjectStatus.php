<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\ProjectManagement\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Task type enum.
 *
 * @package    Modules\ProjectManagement\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class ProjectStatus extends Enum
{
    public const ACTIVE   = 0;
    public const INACTIVE = 1;
    public const HOLD     = 2;
    public const CANCELED = 3;
    public const FINISHED = 4;
}
