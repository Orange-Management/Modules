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
namespace Modules\Accounting\Models;

use Modules\Accounting\Models\PersonalAccount;

/**
 * Creditor account class.
 *
 * @category   Modules
 * @package    Modules\Accounting\Models
 * @author     OMS Development Team <dev@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class CreditorAccount extends PersonalAccount
{

    /**
     * Constructor.
     *
     * @since  1.0.0
     */
    public function __construct()
    {
    }

    public function getPDO()
    {
    }

    public function getDefault()
    {
    }
}
