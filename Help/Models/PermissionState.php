<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Help
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Help\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package Modules\Help
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class PermissionState extends Enum
{
    public const HELP_GENERAL   = 1;
    public const HELP_MODULE    = 2;
    public const HELP_DEVELOPER = 3;
}
