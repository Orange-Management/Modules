<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Dashboard
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Dashboard\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;

/**
 * Mapper class.
 *
 * @package    Modules\Dashboard
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class DashboardComponentMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
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
    protected static $belongsTo = [
        'board' => [
            'mapper' => DashboardBoardMapper::class,
            'src'    => 'dashboard_component_board',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'dashboard_component';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'dashboard_component_id';
}
