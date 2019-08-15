<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Support
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Support\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\Support
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const SUPPORT   = 1;
    public const ANALYSIS  = 2;
    public const SETTINGS  = 3;
    public const DASHBOARD = 4;
}
