<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Tasks\Models;

use Modules\Calendar\Models\ScheduleMapper;
use Modules\Tasks\Models\TaskElementMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

/**
 * Mapper class.
 *
 * @category   Tasks
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class TaskMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'task_id'      => ['name' => 'task_id', 'type' => 'int', 'internal' => 'id'],
        'task_title'   => ['name' => 'task_title', 'type' => 'string', 'internal' => 'title'],
        'task_desc'    => ['name' => 'task_desc', 'type' => 'string', 'internal' => 'description'],
        'task_type'    => ['name' => 'task_type', 'type' => 'int', 'internal' => 'type'],
        'task_status'  => ['name' => 'task_status', 'type' => 'int', 'internal' => 'status'],
        'task_due'     => ['name' => 'task_due', 'type' => 'DateTime', 'internal' => 'due'],
        'task_done'    => ['name' => 'task_done', 'type' => 'DateTime', 'internal' => 'done'],
        'task_schedule'    => ['name' => 'task_schedule', 'type' => 'int', 'internal' => 'schedule'],
        'task_created_by' => ['name' => 'task_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'task_created_at' => ['name' => 'task_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'taskElements' => [
            'mapper'         => TaskElementMapper::class,
            'table'          => 'task_element',
            'dst'            => 'task_element_task',
            'src'            => null,
        ],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'schedule' => [
            'mapper'         => ScheduleMapper::class,
            'src'            => 'task_schedule',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'task';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'task_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'task_id';

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
                  ->values($obj->getCreatedBy(), 'task', 'task', 1, $objId, 1, 1, 1, 1, 1);

            self::$db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            return false;
        }

        return $objId;
    }

    /**
     * Find.
     *
     * @param array $columns Columns to select
     *
     * @return Builder
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function find(...$columns) : Builder
    {
        return parent::find(...$columns)->from('account_permission')
                     ->where('account_permission.account_permission_for', '=', 'task')
                     ->where('account_permission.account_permission_id1', '=', 1)
                     ->where('task.task_id', '=', new Column('account_permission.account_permission_id2'))
                     ->where('account_permission.account_permission_r', '=', 1);
    }
}
