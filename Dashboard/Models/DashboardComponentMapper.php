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

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Dashboard\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class DashboardComponentMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'dashboard_component_id'        => ['name' => 'dashboard_component_id',        'type' => 'int',    'internal' => 'id'],
        'dashboard_component_order'     => ['name' => 'dashboard_component_order',     'type' => 'int',    'internal' => 'order'],
        'dashboard_component_module'    => ['name' => 'dashboard_component_module',    'type' => 'string', 'internal' => 'module'],
        'dashboard_component_component' => ['name' => 'dashboard_component_component', 'type' => 'string', 'internal' => 'component'],
        'dashboard_component_board'     => ['name' => 'dashboard_component_board',     'type' => 'int',    'internal' => 'board'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'board' => [
            'mapper' => DashboardBoardMapper::class,
            'self'   => 'dashboard_component_board',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'dashboard_component';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'dashboard_component_id';
}
