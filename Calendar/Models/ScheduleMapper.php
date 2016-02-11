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

class ScheduleMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'schedule_id'                     => ['name' => 'schedule_id', 'type' => 'int', 'internal' => 'id'],
        'schedule_uid'                    => ['name' => 'schedule_uid', 'type' => 'string', 'internal' => 'uid'],
        'schedule_status'                 => ['name' => 'schedule_status', 'type' => 'int', 'internal' => 'status'],
        'schedule_freq_type'              => ['name' => 'schedule_freq_type', 'type' => 'int', 'internal' => 'freqType'],
        'schedule_freq_interval'          => ['name' => 'schedule_freq_interval', 'type' => 'int', 'internal' => 'freqInterval'],
        'schedule_freq_interval_type'     => ['name' => 'schedule_freq_interval_type', 'type' => 'int', 'internal' => 'intervalType'],
        'schedule_freq_relative_interval' => ['name' => 'schedule_freq_relative_interval', 'type' => 'int', 'internal' => 'relativeInternal'],
        'schedule_freq_recurrence_factor' => ['name' => 'schedule_freq_recurrence_factor', 'type' => 'int', 'internal' => 'recurrenceFactor'],
        'schedule_start'                  => ['name' => 'schedule_start', 'type' => 'DateTime', 'internal' => 'start'],
        'schedule_duration'               => ['name' => 'schedule_duration', 'type' => 'int', 'internal' => 'duration'],
        'schedule_end'                    => ['name' => 'schedule_end', 'type' => 'DateTime', 'internal' => 'end'],
        'scheule_created_at'              => ['name' => 'scheule_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
        'scheule_created_by'              => ['name' => 'scheule_created_by', 'type' => 'int', 'internal' => 'createdBy'],
    ];

    protected static $hasMany = [
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'schedule';

    protected static $createdAt = 'schedule_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'schedule_id';

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
                  ->values($obj->getCreatedBy(), 'calendar', 'calendar', 1, $objId, 1, 1, 1, 1, 1);

            $this->db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
            var_dump($e);

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
                     ->where('account_permission.account_permission_for', '=', 'calendar')
                     ->where('account_permission.account_permission_id1', '=', 1)
                     ->where('calendar.calendar_id', '=', new Column('account_permission.account_permission_id2'))
                     ->where('account_permission.account_permission_r', '=', 1);
    }
}
