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
namespace Modules\Accounting\Models;

use phpOMS\Datatypes\Enum;

/**
 * Time range type enum.
 *
 * @category   Modules
 * @package    Modules\Accounting\Models
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class TimeRangeType extends Enum
{
    /* public */ const ENTRY_DATE      = 0; /* Date of when the entry happened */
    /* public */ const DUE_DATE        = 1; /* Date of when the entry is due (only for invoices) */
    /* public */ const RECEIPT_DATE    = 2; /* Date of the receipt */
    /* public */ const ASSOCIATED_DATE = 3; /* Date of the association (e.g. when did the articles arrive) */
}
