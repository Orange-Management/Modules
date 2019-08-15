<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\CostCenterAccounting
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\CostCenterAccounting\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\CostCenterAccounting
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const COST_CENTER = 1;
}
