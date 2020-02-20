<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\EventManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\EventManagement\Models;

use Modules\Media\Models\MediaMapper;
use Modules\Tasks\Models\TaskMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\EventManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class EventMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'eventmanagement_event_id'            => ['name' => 'eventmanagement_event_id',            'type' => 'int',          'internal' => 'id'],
        'eventmanagement_event_name'          => ['name' => 'eventmanagement_event_name',          'type' => 'string',       'internal' => 'name'],
        'eventmanagement_event_description'   => ['name' => 'eventmanagement_event_description',   'type' => 'string',       'internal' => 'description'],
        'eventmanagement_event_type'          => ['name' => 'eventmanagement_event_type',          'type' => 'int',          'internal' => 'type'],
        'eventmanagement_event_calendar'      => ['name' => 'eventmanagement_event_calendar',      'type' => 'int',          'internal' => 'calendar'],
        'eventmanagement_event_start'         => ['name' => 'eventmanagement_event_start',         'type' => 'DateTime',     'internal' => 'start'],
        'eventmanagement_event_end'           => ['name' => 'eventmanagement_event_end',           'type' => 'DateTime',     'internal' => 'end'],
        'eventmanagement_event_progress'      => ['name' => 'eventmanagement_event_progress',      'type' => 'int',          'internal' => 'progress'],
        'eventmanagement_event_progress_type' => ['name' => 'eventmanagement_event_progress_type', 'type' => 'int',          'internal' => 'progressType'],
        'eventmanagement_event_costs'         => ['name' => 'eventmanagement_event_costs',         'type' => 'Serializable', 'internal' => 'costs'],
        'eventmanagement_event_budget'        => ['name' => 'eventmanagement_event_budget',        'type' => 'Serializable', 'internal' => 'budget'],
        'eventmanagement_event_earnings'      => ['name' => 'eventmanagement_event_earnings',      'type' => 'Serializable', 'internal' => 'earnings'],
        'eventmanagement_event_created_by'    => ['name' => 'eventmanagement_event_created_by',    'type' => 'int',          'internal' => 'createdBy'],
        'eventmanagement_event_created_at'    => ['name' => 'eventmanagement_event_created_at',    'type' => 'DateTime',     'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'tasks' => [
            'mapper' => TaskMapper::class,
            'table'  => 'eventmanagement_task_relation',
            'external' => 'eventmanagement_task_relation_dst',
            'self'   => 'eventmanagement_task_relation_src',
        ],
        'media' => [
            'mapper' => MediaMapper::class,
            'table'  => 'eventmanagement_event_media',
            'external' => 'eventmanagement_event_media_src',
            'self'   => 'eventmanagement_event_media_dst',
        ],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:string, self:string, by?:string}>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'calendar' => [
            'mapper' => \Modules\Calendar\Models\CalendarMapper::class,
            'self'   => 'eventmanagement_event_calendar',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'eventmanagement_event';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'eventmanagement_event_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'eventmanagement_event_id';
}
