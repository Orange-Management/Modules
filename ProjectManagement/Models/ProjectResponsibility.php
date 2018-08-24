<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\ProjectManagement\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Task type enum.
 *
 * @package    Modules\ProjectManagement\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class ProjectResponsibility extends Enum
{
    public const MANAGER = 0;
    public const OTHER   = 1;
}
