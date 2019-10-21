<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\HumanResourceTimeRecording\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\HumanResourceTimeRecording\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package Modules\HumanResourceTimeRecording\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class PermissionState extends Enum
{
    public const DASHBOARD               = 1;
    public const PRIVATE_DASHBOARD       = 2;
    public const SESSION                 = 3;
    public const SESSION_FOREIGN         = 4;
    public const SESSION_ELEMENT         = 5;
    public const SESSION_ELEMENT_FOREIGN = 6;
}
