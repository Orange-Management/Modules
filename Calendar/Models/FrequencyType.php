<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Calendar\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Frequency type enum.
 *
 * @package    Modules\Calendar\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class FrequencyType extends Enum
{
    public const ONCE = 1;

    public const DAILY = 2;

    public const WEEKLY = 4;

    public const MONTHLY = 8;

    public const YEARLY = 16;
}
