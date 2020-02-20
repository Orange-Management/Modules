<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Calendar\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 *
 * @todo Orange-Management/Modules#191
 *  When showing a calendar the default behavior should be to only load a fixed amount of months in order to avoid unnecessary overhead.
 *  Maybe only load the current month, the next month and the previous month.
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class CalendarMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'calendar_id'          => ['name' => 'calendar_id',          'type' => 'int',      'internal' => 'id'],
        'calendar_name'        => ['name' => 'calendar_name',        'type' => 'string',   'internal' => 'name'],
        'calendar_description' => ['name' => 'calendar_description', 'type' => 'string',   'internal' => 'description'],
        'calendar_created_at'  => ['name' => 'calendar_created_at',  'type' => 'DateTime', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'events' => [
            'mapper' => EventMapper::class,
            'table'  => 'calendar_event',
            'external' => 'calendar_event_calendar',
            'self'   => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'calendar';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'calendar_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'calendar_id';
}
