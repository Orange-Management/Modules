<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\PersonnelTimeManagement\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\PersonnelTimeManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Work status enum.
 *
 * @package    Modules\PersonnelTimeManagement\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class TimeStatus extends Enum
{
    public const ACCEPTED = 0;

    public const OPEN = 1;
}
