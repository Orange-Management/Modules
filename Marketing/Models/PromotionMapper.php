<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Marketing\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Marketing\Models;

use Modules\Calendar\Models\CalendarMapper;
use Modules\Media\Models\MediaMapper;
use Modules\Tasks\Models\TaskMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Marketing\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class PromotionMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'marketing_promotion_id'            => ['name' => 'marketing_promotion_id',            'type' => 'int',          'internal' => 'id'],
        'marketing_promotion_name'          => ['name' => 'marketing_promotion_name',          'type' => 'string',       'internal' => 'name'],
        'marketing_promotion_description'   => ['name' => 'marketing_promotion_description',   'type' => 'string',       'internal' => 'description'],
        'marketing_promotion_calendar'      => ['name' => 'marketing_promotion_calendar',      'type' => 'int',          'internal' => 'calendar'],
        'marketing_promotion_costs'         => ['name' => 'marketing_promotion_costs',         'type' => 'Serializable', 'internal' => 'costs'],
        'marketing_promotion_budget'        => ['name' => 'marketing_promotion_budget',        'type' => 'Serializable', 'internal' => 'budget'],
        'marketing_promotion_earnings'      => ['name' => 'marketing_promotion_earnings',      'type' => 'Serializable', 'internal' => 'earnings'],
        'marketing_promotion_start'         => ['name' => 'marketing_promotion_start',         'type' => 'DateTime',     'internal' => 'start'],
        'marketing_promotion_end'           => ['name' => 'marketing_promotion_end',           'type' => 'DateTime',     'internal' => 'end'],
        'marketing_promotion_progress'      => ['name' => 'marketing_promotion_progress',      'type' => 'int',          'internal' => 'progress'],
        'marketing_promotion_progress_type' => ['name' => 'marketing_promotion_progress_type', 'type' => 'int',          'internal' => 'progressType'],
        'marketing_promotion_created_by'    => ['name' => 'marketing_promotion_created_by',    'type' => 'int',          'internal' => 'createdBy'],
        'marketing_promotion_created_at'    => ['name' => 'marketing_promotion_created_at',    'type' => 'DateTime',     'internal' => 'createdAt', 'readonly' => true],
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
            'table'  => 'marketing_promotion_task_relation',
            'external' => 'marketing_promotion_task_relation_dst',
            'self'   => 'marketing_promotion_task_relation_src',
        ],
        'media' => [
            'mapper' => MediaMapper::class,
            'table'  => 'marketing_promotion_media',
            'external' => 'marketing_promotion_media_src',
            'self'   => 'marketing_promotion_media_dst',
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
            'mapper' => CalendarMapper::class,
            'self'   => 'marketing_promotion_calendar',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'marketing_promotion';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'marketing_promotion_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'marketing_promotion_id';
}
