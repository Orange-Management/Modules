<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\EventManagement\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;
use Modules\Tasks\Models\TaskMapper;

/**
 * Mapper class.
 *
 * @category   Calendar
 * @package    Modules
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class EventMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $columns = [
        'eventmanagement_event_id'         => ['name' => 'eventmanagement_event_id', 'type' => 'int', 'internal' => 'id'],
        'eventmanagement_event_name'       => ['name' => 'eventmanagement_event_name', 'type' => 'string', 'internal' => 'name'],
        'eventmanagement_event_description'       => ['name' => 'eventmanagement_event_description', 'type' => 'string', 'internal' => 'description'],
        'eventmanagement_event_type'       => ['name' => 'eventmanagement_event_type', 'type' => 'int', 'internal' => 'type'],
        'eventmanagement_event_calendar'   => ['name' => 'eventmanagement_event_calendar', 'type' => 'int', 'internal' => 'calendar'],
        'eventmanagement_event_start'       => ['name' => 'eventmanagement_event_start', 'type' => 'DateTime', 'internal' => 'start'],
        'eventmanagement_event_end'         => ['name' => 'eventmanagement_event_end', 'type' => 'DateTime', 'internal' => 'end'],
        'eventmanagement_event_progress'         => ['name' => 'eventmanagement_event_progress', 'type' => 'int', 'internal' => 'progress'],
        'eventmanagement_event_progress_type'         => ['name' => 'eventmanagement_event_progress_type', 'type' => 'int', 'internal' => 'progressType'],
        'eventmanagement_event_costs'      => ['name' => 'eventmanagement_event_costs', 'type' => 'Serializable', 'internal' => 'costs'],
        'eventmanagement_event_budget'     => ['name' => 'eventmanagement_event_budget', 'type' => 'Serializable', 'internal' => 'budget'],
        'eventmanagement_event_earnings'   => ['name' => 'eventmanagement_event_earnings', 'type' => 'Serializable', 'internal' => 'earnings'],
        'eventmanagement_event_created_by' => ['name' => 'eventmanagement_event_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'eventmanagement_event_created_at' => ['name' => 'eventmanagement_event_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $hasMany = [
        'tasks' => [
            'mapper'         => TaskMapper::class,
            'table'          => 'eventmanagement_task_relation',
            'dst'            => 'eventmanagement_task_relation_dst',
            'src'            => 'eventmanagement_task_relation_src',
        ],
    ];

    /**
     * Has one relation.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'calendar' => [
            'mapper' => \Modules\Calendar\Models\CalendarMapper::class,
            'src'    => 'eventmanagement_event_calendar',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'eventmanagement_event';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'eventmanagement_event_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'eventmanagement_event_id';

    /**
     * Create object.
     *
     * @param mixed $obj       Object
     * @param int   $relations Behavior for relations creation
     *
     * @return mixed
     *
     * @since  1.0.0
     */
    public static function create($obj, int $relations = RelationType::ALL)
    {
        try {
            $objId = parent::create($obj, $relations);
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            return false;
        }

        return $objId;
    }
}
