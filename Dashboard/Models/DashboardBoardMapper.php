<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Dashboard\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Dashboard\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Dashboard\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class DashboardBoardMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'dashboard_board_id'      => ['name' => 'dashboard_board_id',      'type' => 'int',    'internal' => 'id'],
        'dashboard_board_title'   => ['name' => 'dashboard_board_title',   'type' => 'string', 'internal' => 'title'],
        'dashboard_board_status'  => ['name' => 'dashboard_board_status',  'type' => 'int',    'internal' => 'status'],
        'dashboard_board_account' => ['name' => 'dashboard_board_account', 'type' => 'int',    'internal' => 'account'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'components' => [
            'mapper' => DashboardComponentMapper::class,
            'table'  => 'dashboard_component',
            'external' => 'dashboard_component_board',
            'self'   => null,
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'account' => [
            'mapper' => AccountMapper::class,
            'self'   => 'dashboard_board_account',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'dashboard_board';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'dashboard_board_id';
}
