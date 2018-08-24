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
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Schedule status enum.
 *
 * @package    Modules\Calendar\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class ScheduleStatus extends Enum
{
    public const ACTIVE   = 1;
    public const INACTIVE = 1;
}
