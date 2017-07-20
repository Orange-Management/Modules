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
namespace Modules\Calendar\Models;

use phpOMS\Datatypes\Enum;

/**
 * Frequency relative type enum.
 *
 * @category   Calendar
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class FrequencyRelative extends Enum
{
    /* public */ const FIRST = 1;

    /* public */ const SECOND = 2;

    /* public */ const THIRD = 4;

    /* public */ const FOURTH = 8;

    /* public */ const LAST = 64;
}
