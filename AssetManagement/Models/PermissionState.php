<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\AssetManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\AssetManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package Modules\AssetManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class PermissionState extends Enum
{
    public const ASSET = 1;
}
