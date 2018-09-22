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

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Account permission mapper class.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class AccountPermissionMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, string|bool>>
     * @since 1.0.0
     */
    protected static $columns = [
        'account_permission_id'         => ['name' => 'account_permission_id', 'type' => 'int', 'internal' => 'id'],
        'account_permission_account'    => ['name' => 'account_permission_account', 'type' => 'int', 'internal' => 'account'],
        'account_permission_unit'       => ['name' => 'account_permission_unit', 'type' => 'int', 'internal' => 'unit'],
        'account_permission_app'        => ['name' => 'account_permission_app', 'type' => 'int', 'internal' => 'app'],
        'account_permission_module'     => ['name' => 'account_permission_module', 'type' => 'string', 'internal' => 'module'],
        'account_permission_from'       => ['name' => 'account_permission_from', 'type' => 'int', 'internal' => 'from'],
        'account_permission_type'       => ['name' => 'account_permission_type', 'type' => 'int', 'internal' => 'type'],
        'account_permission_element'    => ['name' => 'account_permission_element', 'type' => 'int', 'internal' => 'element'],
        'account_permission_component'  => ['name' => 'account_permission_component', 'type' => 'int', 'internal' => 'component'],
        'account_permission_permission' => ['name' => 'account_permission_permission', 'type' => 'int', 'internal' => 'permission'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'account_permission';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'account_permission_id';
}
