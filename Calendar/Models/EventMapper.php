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
namespace Modules\Calendar\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;

class EventMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'calendar_event_id'          => ['name' => 'calendar_event_id', 'type' => 'int', 'internal' => 'id'],
        'calendar_event_name'        => ['name' => 'calendar_event_name', 'type' => 'string', 'internal' => 'name'],
        'calendar_event_description' => ['name' => 'calendar_event_description', 'type' => 'string', 'internal' => 'description'],
        'calendar_event_location'    => ['name' => 'calendar_event_location', 'type' => 'Serializable', 'internal' => 'location'],
        'calendar_event_status'      => ['name' => 'calendar_event_status', 'type' => 'int', 'internal' => 'status'],
        'calendar_event_calendar'    => ['name' => 'calendar_event_calendar', 'type' => 'int', 'internal' => 'calendar'],
        'calendar_event_created_by'  => ['name' => 'calendar_event_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'calendar_event_created_at'  => ['name' => 'calendar_event_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'calendar_event';

    protected static $createdAt = 'calendar_event_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'calendar_event_id';

    /**
     * Create media.
     *
     * @param Calendar $obj Media
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