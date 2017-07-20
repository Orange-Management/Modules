<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Organization\Models;

use phpOMS\Datatypes\Enum;

/**
 * Accept status enum.
 *
 * @category   Calendar
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class Status extends Enum
{
    /* public */ const ACTIVE = 1;

    /* public */ const INACTIVE = 2;

    /* public */ const HIDDEN = 4;
}
