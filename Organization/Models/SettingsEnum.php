<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Organization\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Organization\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Module settings enum.
 *
 * @package  Modules\Organization\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class SettingsEnum extends Enum
{
    public const GROUP_GENERATE_AUTOMATICALLY_UNIT       = 1004700001;
    public const GROUP_GENERATE_AUTOMATICALLY_DEPARTMENT = 1004700002;
    public const GROUP_GENERATE_AUTOMATICALLY_POSITION   = 1004700003;
}
