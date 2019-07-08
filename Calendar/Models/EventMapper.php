<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Calendar\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package    Modules\Calendar\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class EventMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'calendar_event_id'          => ['name' => 'calendar_event_id', 'type' => 'int', 'internal' => 'id'],
        'calendar_event_name'        => ['name' => 'calendar_event_name', 'type' => 'string', 'internal' => 'name'],
        'calendar_event_description' => ['name' => 'calendar_event_description', 'type' => 'string', 'internal' => 'description'],
        'calendar_event_location'    => ['name' => 'calendar_event_location', 'type' => 'Serializable', 'internal' => 'location'],
        'calendar_event_type'        => ['name' => 'calendar_event_type', 'type' => 'int', 'internal' => 'type'],
        'calendar_event_status'      => ['name' => 'calendar_event_status', 'type' => 'int', 'internal' => 'status'],
        'calendar_event_schedule'    => ['name' => 'calendar_event_schedule', 'type' => 'int', 'internal' => 'schedule'],
        'calendar_event_calendar'    => ['name' => 'calendar_event_calendar', 'type' => 'int', 'internal' => 'calendar'],
        'calendar_event_created_by'  => ['name' => 'calendar_event_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'calendar_event_created_at'  => ['name' => 'calendar_event_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'schedule' => [
            'mapper' => ScheduleMapper::class,
            'src'    => 'calendar_event_schedule',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'calendar_event';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'calendar_event_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'calendar_event_id';
}
