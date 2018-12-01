<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\Account\PermissionAbstract;

/**
 * Account permission class.
 *
 * A single permission for an account consisting of read, create, modify, delete and permission flags.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class AccountPermission extends PermissionAbstract
{
    /**
     * Account id
     *
     * @var int
     * @since 1.0.0
     */
    private $account = 0;

    /**
     * Constructor.
     *
     * @param int $account Group id
     *
     * @since  1.0.0
     */
    public function __construct(int $account = 0)
    {
        $this->account = $account;
    }

    /**
     * Get account id
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getAccount() : int
    {
        return $this->account;
    }
}
