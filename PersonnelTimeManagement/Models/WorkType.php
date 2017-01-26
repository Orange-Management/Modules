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
namespace Modules\PersonnelTimeManagement\Models;

use phpOMS\Datatypes\Enum;

/**
 * Work status enum.
 *
 * @category   Module
 * @package    Modules\HumanResources
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class WorkType extends Enum
{
    const OFF = 0;

    const WORKING = 1;

    const LATE = 2;

    const SICK = 3;

    const VACATION = 4;

    const REMOTE = 5;

    const TRAVEL = 6;
}
