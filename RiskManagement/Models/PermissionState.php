<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\RiskManagement
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\RiskManagement
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const COCKPIT    = 1;
    public const RISK       = 2;
    public const CAUSE      = 3;
    public const SOLUTION   = 4;
    public const UNIT       = 5;
    public const DEPARTMENT = 6;
    public const CATEGORY   = 7;
    public const PROJECT    = 8;
    public const PROCESS    = 9;
    public const SETTINGS   = 10;
}
