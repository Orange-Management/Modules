<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Job\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Job\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Task status enum.
 *
 * @package    Modules\Job\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class JobStatus extends Enum
{
    public const RUNNING   = 1;
    public const WAITING   = 2;
    public const SUSPENDED = 3;
    public const DONE      = 4;
}
