<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
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
    const OPEN = 1;
    const WORKING = 2;
    const SUSPENDED = 3;
    const CANCELED = 4;
    const DONE = 5;
    const CLOSED = 6;
}
