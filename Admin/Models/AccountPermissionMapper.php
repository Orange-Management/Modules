<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Account permission mapper class.
 *
 * @package Modules\Admin\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class AccountPermissionMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'account_permission_id'         => ['name' => 'account_permission_id',         'type' => 'int',    'internal' => 'id'],
        'account_permission_account'    => ['name' => 'account_permission_account',    'type' => 'int',    'internal' => 'account'],
        'account_permission_unit'       => ['name' => 'account_permission_unit',       'type' => 'int',    'internal' => 'unit'],
        'account_permission_app'        => ['name' => 'account_permission_app',        'type' => 'string', 'internal' => 'app'],
        'account_permission_module'     => ['name' => 'account_permission_module',     'type' => 'string', 'internal' => 'module'],
        'account_permission_from'       => ['name' => 'account_permission_from',       'type' => 'int',    'internal' => 'from'],
        'account_permission_type'       => ['name' => 'account_permission_type',       'type' => 'int',    'internal' => 'type'],
        'account_permission_element'    => ['name' => 'account_permission_element',    'type' => 'int',    'internal' => 'element'],
        'account_permission_component'  => ['name' => 'account_permission_component',  'type' => 'int',    'internal' => 'component'],
        'account_permission_permission' => ['name' => 'account_permission_permission', 'type' => 'int',    'internal' => 'permission'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'account_permission';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'account_permission_id';
}
