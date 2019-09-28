<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class PermissionState extends Enum
{
    public const PERSONAL    = 1;
    public const IMPERSONAL  = 2;
    public const JOURNAL     = 3;
    public const STACK       = 4;
    public const GL          = 5;
    public const COST_CENTER = 6;
    public const ACCOUNT     = 7;
    public const ENTRY       = 8;
}
