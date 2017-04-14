<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Calendar\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

/**
 * Mapper class.
 *
 * @category   Calendar
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
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
     * @var array
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

    /**
     * Create object.
     *
     * @param mixed $obj       Object
     * @param int   $relations Behavior for relations creation
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function create($obj, int $relations = RelationType::ALL)
    {
        try {
            $objId = parent::create($obj, $relations);

            if($objId === null || !is_scalar($objId)) {
                return $objId;
            }

            $query = new Builder(self::$db);

            $query->prefix(self::$db->getPrefix())
                  ->insert(
                      'account_permission_account',
                      'account_permission_from',
                      'account_permission_for',
                      'account_permission_id1',
                      'account_permission_id2',
                      'account_permission_r',
                      'account_permission_w',
                      'account_permission_m',
                      'account_permission_d',
                      'account_permission_p'
                  )
                  ->into('account_permission')
                  ->values($obj->getCreatedBy(), 'calendar_event', 'calendar_event', 1, $objId, 1, 1, 1, 1, 1);

            self::$db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            return false;
        }

        return $objId;
    }
}
