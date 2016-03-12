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
namespace Modules\EventManagement\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;

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
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'eventmanagement_event_id'          => ['name' => 'eventmanagement_event_id', 'type' => 'int', 'internal' => 'id'],
        'eventmanagement_event_type'          => ['name' => 'eventmanagement_event_type', 'type' => 'int', 'internal' => 'type'],
        'eventmanagement_event_event'          => ['name' => 'eventmanagement_event_event', 'type' => 'int', 'internal' => 'event'],
        'eventmanagement_event_costs'          => ['name' => 'eventmanagement_event_costs', 'type' => 'Serializable', 'internal' => 'costs'],
        'eventmanagement_event_budget'          => ['name' => 'eventmanagement_event_budget', 'type' => 'Serializable', 'internal' => 'budget'],
        'eventmanagement_event_earnings'          => ['name' => 'eventmanagement_event_earnings', 'type' => 'Serializable', 'internal' => 'earnings'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $hasOne = [
        'event' => [
            'mapper' => \Modules\Calendar\Models\EventMapper::class,
            'src'    => 'eventmanagement_event_event',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'sources' => [
            'mapper'         => \Modules\Tasks\Models\TaskMapper::class, /* mapper of the related object */
            'relationmapper' => null, /* if the relation itself is a more complex object that has it's own mapper */
            'table'          => 'eventmanager_task_relation', /* table of the related object, null if no relation table is used (many->1) */
            'dst'            => 'eventmanager_task_relation_dst',
            'src'            => 'eventmanager_task_relation_src',
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
     * Create media.
     *
     * @param Event $obj Media
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function create($obj)
    {
        try {
            $objId = parent::create($obj);
            $query = new Builder($this->db);
            $query->prefix($this->db->getPrefix())
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

            $this->db->con->prepare($query->toSql())->execute();
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
    public function find(...$columns) : Builder
    {
        return parent::find(...$columns)->from('account_permission')
                     ->where('account_permission.account_permission_for', '=', 'calendar_event')
                     ->where('account_permission.account_permission_id1', '=', 1)
                     ->where('calendar_event.calendar_event_id', '=', new Column('account_permission.account_permission_id2'))
                     ->where('account_permission.account_permission_r', '=', 1);
    }
}
