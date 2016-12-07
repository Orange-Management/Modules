<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Workflow\Models;

use phpOMS\Datatypes\Enum;

/**
 * Task status enum.
 *
 * @category   Workflow
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class WorkflowStatus extends Enum
{
    /* public */ const OPEN = 1;
    /* public */ const WORKING = 2;
    /* public */ const SUSPENDED = 3;
    /* public */ const CANCELED = 4;
    /* public */ const DONE = 5;
    /* public */ const CLOSED = 6;
}
