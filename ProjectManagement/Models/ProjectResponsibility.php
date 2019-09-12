<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\ProjectManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Task type enum.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class ProjectResponsibility extends Enum
{
    public const MANAGER = 0;
    public const OTHER   = 1;
}
