<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

/**
 * ImpersonalAccount class.
 *
 * @package    Modules
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class PersonalAccountAbstract extends AccountAbstract
{
    public function __construct(int $id)
    {
        parent::__construct($id);
    }

    public function getBalance()
    {
    }

    public function getAccountsReceivable()
    {
    }

    public function getAccountsPayable()
    {
    }

    public function getAccountsHistory($start, $end)
    {
    }
}
