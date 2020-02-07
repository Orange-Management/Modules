<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\ProjectManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use Modules\Calendar\Models\CalendarMapper;
use Modules\Media\Models\MediaMapper;
use Modules\Tasks\Models\TaskMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ProjectMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'projectmanagement_project_id'              => ['name' => 'projectmanagement_project_id',              'type' => 'int',          'internal' => 'id'],
        'projectmanagement_project_name'            => ['name' => 'projectmanagement_project_name',            'type' => 'string',       'internal' => 'name'],
        'projectmanagement_project_description'     => ['name' => 'projectmanagement_project_description',     'type' => 'string',       'internal' => 'description'],
        'projectmanagement_project_description_raw' => ['name' => 'projectmanagement_project_description_raw', 'type' => 'string',       'internal' => 'descriptionRaw'],
        'projectmanagement_project_calendar'        => ['name' => 'projectmanagement_project_calendar',        'type' => 'int',          'internal' => 'calendar'],
        'projectmanagement_project_costs'           => ['name' => 'projectmanagement_project_costs',           'type' => 'Serializable', 'internal' => 'costs'],
        'projectmanagement_project_budgetcosts'     => ['name' => 'projectmanagement_project_budgetcosts',     'type' => 'Serializable', 'internal' => 'budgetCosts'],
        'projectmanagement_project_budgetearnings'  => ['name' => 'projectmanagement_project_budgetearnings',  'type' => 'Serializable', 'internal' => 'budgetEarnings'],
        'projectmanagement_project_earnings'        => ['name' => 'projectmanagement_project_earnings',        'type' => 'Serializable', 'internal' => 'earnings'],
        'projectmanagement_project_start'           => ['name' => 'projectmanagement_project_start',           'type' => 'DateTime',     'internal' => 'start'],
        'projectmanagement_project_end'             => ['name' => 'projectmanagement_project_end',             'type' => 'DateTime',     'internal' => 'end'],
        'projectmanagement_project_endestimated'    => ['name' => 'projectmanagement_project_endestimated',    'type' => 'DateTime',     'internal' => 'endEstimated'],
        'projectmanagement_project_progress'        => ['name' => 'projectmanagement_project_progress',        'type' => 'int',          'internal' => 'progress'],
        'projectmanagement_project_progress_type'   => ['name' => 'projectmanagement_project_progress_type',   'type' => 'int',          'internal' => 'progressType'],
        'projectmanagement_project_created_by'      => ['name' => 'projectmanagement_project_created_by',      'type' => 'int',          'internal' => 'createdBy'],
        'projectmanagement_project_created_at'      => ['name' => 'projectmanagement_project_created_at',      'type' => 'DateTime',     'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'tasks' => [
            'mapper' => TaskMapper::class,
            'table'  => 'projectmanagement_task_relation',
            'external' => 'projectmanagement_task_relation_dst',
            'self'   => 'projectmanagement_task_relation_src',
        ],
        'media' => [
            'mapper' => MediaMapper::class,
            'table'  => 'projectmanagement_project_media',
            'external' => 'projectmanagement_project_media_src',
            'self'   => 'projectmanagement_project_media_dst',
        ],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'calendar' => [
            'mapper' => CalendarMapper::class,
            'self'   => 'projectmanagement_project_calendar',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'projectmanagement_project';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'projectmanagement_project_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'projectmanagement_project_id';
}
