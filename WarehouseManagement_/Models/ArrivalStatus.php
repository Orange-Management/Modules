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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Warehousing\Models;

use phpOMS\Datatypes\Enum;

/**
 * Arrival status enum.
 *
 * @category   Warehousing
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ArrivalStatus extends Enum
{
    /* public */ const NONE = 0;

    /* public */ const PENDING = 1;

    /* public */ const CHECKING = 2;

    /* public */ const SORTING = 3;

    /* public */ const FINISHED = 4;
}
