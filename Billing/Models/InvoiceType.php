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
declare(strict_types=1);
namespace Modules\Billing\Models;

use phpOMS\Datatypes\Enum;

/**
 * Task type enum.
 *
 * @category   Tasks
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class InvoiceType extends Enum
{
    /* public */ const BILL = 1;
    /* public */ const DELIVERY_NOTE  = 2;
    /* public */ const CREDIT_NOTE   = 3;
    /* public */ const DEBIT_NOTE   = 4;
    /* public */ const OFFER   = 5;
    /* public */ const ORDER_CONFIRMATION = 6;
}