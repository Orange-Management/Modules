<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

use Modules\Admin\Models\Account;

/**
 * Creditor class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Creditor
{
    /**
     * Creditor ID.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Account.
     *
     * @var   null|int|phpOMS/Account/Account
     * @since 1.0.0
     */
    protected $account = null;

    /**
     * Get id.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get account.
     *
     * @return null|int|Account
     *
     * @since 1.0.0
     */
    public function getAccount()
    {
        return $this->account;
    }
}
