<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\ProjectManagement\Models;

use phpOMS\Datatypes\Enum;

/**
 * Task type enum.
 *
 * @category   Tasks
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ProjectStatus extends Enum
{
    /* public */ const ACTIVE   = 0;
    /* public */ const INACTIVE = 1;
    /* public */ const HOLD     = 2;
    /* public */ const CANCELED = 3;
    /* public */ const FINISHED = 4;
}
