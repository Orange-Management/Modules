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
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Sales\Models;

use phpOMS\Datatypes\Enum;

/**
 * Invoice types enum.
 *
 * @category   Modules
 * @package    Sales
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class InvoiceStatus extends Enum
{
    /* public */ const BLOCKED        = 0; /* Invoice needs approval */
    /* public */ const DRAFT          = 1; /* Invoice is still in draft */
    /* public */ const READY          = 2; /* Invoice is ready for accounting transfer */
    /* public */ const UNPAID         = 3; /* Invoice is not paid */
    /* public */ const PAID_PARTIALLY = 4; /* Invoice is partially paid */
    /* public */ const PAID           = 5; /* Invoice is paid */
    /* public */ const OFFSETTING     = 6; /* This invoice may receive a credit */
    /* public */ const OPEN           = 7; /* offer & confirmation */
    /* public */ const CHANGED        = 8; /* offer & confirmation */
    /* public */ const CLOSED         = 9; /* offer & confirmation */
    /* public */ const ACCEPTED       = 10; /* offer & confirmation */
}
