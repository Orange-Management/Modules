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
 * @todo       only load events of 3 month or 1 year?!
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
final class CalendarMapper extends DataMapperAbstract
{
    /**
     * Class name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $CLASS = __CLASS__;

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'calendar_id'          => ['name' => 'calendar_id', 'type' => 'int', 'internal' => 'id'],
        'calendar_name'        => ['name' => 'calendar_name', 'type' => 'string', 'internal' => 'name'],
        'calendar_description' => ['name' => 'calendar_description', 'type' => 'string', 'internal' => 'description'],
        'calendar_created_at'  => ['name' => 'calendar_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'events' => [
            'mapper' => EventMapper::class,
            'table'  => 'calendar_event',
            'dst'    => 'calendar_event_calendar',
            'src'    => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'calendar';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'calendar_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'calendar_id';
}
