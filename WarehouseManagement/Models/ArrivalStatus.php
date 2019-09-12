<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Warehousing\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\WarehouseManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Arrival status enum.
 *
 * @package Modules\Warehousing\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class ArrivalStatus extends Enum
{
    public const NONE = 0;

    public const PENDING = 1;

    public const CHECKING = 2;

    public const SORTING = 3;

    public const FINISHED = 4;
}
