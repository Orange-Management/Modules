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
namespace Modules\Admin\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

class AccountMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'account_id'         => ['name' => 'account_id', 'type' => 'int', 'internal' => 'id'],
        'account_status'     => ['name' => 'account_status', 'type' => 'int', 'internal' => 'status'],
        'account_type'       => ['name' => 'account_type', 'type' => 'int', 'internal' => 'type'],
        'account_login'    => ['name' => 'account_login', 'type' => 'string', 'internal' => 'login'],
        'account_name1'      => ['name' => 'account_name1', 'type' => 'string', 'internal' => 'name1'],
        'account_name2'      => ['name' => 'account_name2', 'type' => 'string', 'internal' => 'name2'],
        'account_name3'      => ['name' => 'account_name3', 'type' => 'string', 'internal' => 'name3'],
        'account_password' => ['name' => 'account_password', 'type' => 'string', 'internal' => 'password'],
        'account_email'      => ['name' => 'account_email', 'type' => 'string', 'internal' => 'email'],
        //'account_tries'    => ['name' => 'account_tries', 'type' => 'int', 'internal' => 'tries'],
        'account_lactive'    => ['name'     => 'account_lactive', 'type' => 'DateTime',
                                 'internal' => 'lastActive'],
        'account_created_at' => ['name' => 'account_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'account';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'account_id';

    /**
     * Created at column
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'account_created_at';
}
