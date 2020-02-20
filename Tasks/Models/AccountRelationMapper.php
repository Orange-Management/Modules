<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tasks\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tasks\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Tasks\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class AccountRelationMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'task_account_id'           => ['name' => 'task_account_id',           'type' => 'int', 'internal' => 'id'],
        'task_account_duty'         => ['name' => 'task_account_duty',         'type' => 'int', 'internal' => 'duty'],
        'task_account_account'      => ['name' => 'task_account_account',      'type' => 'int', 'internal' => 'relation'],
        'task_account_task_element' => ['name' => 'task_account_task_element', 'type' => 'int', 'internal' => 'element'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:string, self:string, by?:string}>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'relation' => [
            'mapper' => AccountMapper::class,
            'self'   => 'task_account_account',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'task_account';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'task_account_id';
}
