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
 * Frequency relative type enum.
 *
 * @package    Modules\Calendar\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class FrequencyRelative extends Enum
{
    public const FIRST = 1;

    public const SECOND = 2;

    public const THIRD = 4;

    public const FOURTH = 8;

    public const LAST = 64;
}
