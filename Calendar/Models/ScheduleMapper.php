<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
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
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class ScheduleMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array
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
        'schedule_created_at'             => ['name' => 'schedule_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
        'schedule_created_by'             => ['name' => 'schedule_created_by', 'type' => 'int', 'internal' => 'createdBy'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'schedule';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'schedule_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'schedule_id';

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
                  ->values($obj->getCreatedBy(), 'schedule', 'schedule', 1, $objId, 1, 1, 1, 1, 1);

            self::$db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            return false;
        }

        return $objId;
    }

}
