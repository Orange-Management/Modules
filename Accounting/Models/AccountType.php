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
namespace Modules\Accounting\Models;

use phpOMS\Datatypes\Enum;

/**
 * Account type enum.
 *
 * @category   Modules
 * @package    Modules\Accounting
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class AccountType extends Enum
{
    /* public */ const IMPERSONAL = 0;

    /* public */ const PERSONAL = 1;

    /* public */ const CREDITOR = 2;

    /* public */ const DEBITOR = 3;
}
