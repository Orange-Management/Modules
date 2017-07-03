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
namespace Modules\RiskManagement\Models;

use Modules\Organization\Models\UnitMapper;
use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

class ProcessMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $columns = [
        'riskmngmt_process_id'         => ['name' => 'riskmngmt_process_id', 'type' => 'int', 'internal' => 'id'],
        'riskmngmt_process_name'     => ['name' => 'riskmngmt_process_name', 'type' => 'string', 'internal' => 'title'],
        'riskmngmt_process_description'     => ['name' => 'riskmngmt_process_description', 'type' => 'string', 'internal' => 'description'],
        'riskmngmt_process_descriptionraw'     => ['name' => 'riskmngmt_process_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_process_department'     => ['name' => 'riskmngmt_process_department', 'type' => 'int', 'internal' => 'department'],
        'riskmngmt_process_unit'     => ['name' => 'riskmngmt_process_unit', 'type' => 'int', 'internal' => 'unit'],
        'riskmngmt_process_responsible'     => ['name' => 'riskmngmt_process_responsible', 'type' => 'int', 'internal' => 'responsible'],
        'riskmngmt_process_deputy'     => ['name' => 'riskmngmt_process_deputy', 'type' => 'int', 'internal' => 'deputy'],
    ];

    protected static $belongsTo = [
        'unit' => [
            'mapper'         => UnitMapper::class,
            'dest'            => 'riskmngmt_cause_risk',
        ],
        'department' => [
            'mapper'         => DepartmentMapper::class,
            'dest'            => 'riskmngmt_cause_department',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'riskmngmt_process';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'riskmngmt_process_id';

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
                ->values(1, 'riskmngmt_process', 'riskmngmt_process', 1, $objId, 1, 1, 1, 1, 1);

            self::$db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            return false;
        }

        return $objId;
    }

    /**
     * Get object.
     *
     * @param mixed $primaryKey Key
     * @param int   $relations  Load relations
     * @param mixed $fill       Object to fill
     *
     * @return Cause
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function get($primaryKey, int $relations = RelationType::ALL, $fill = null)
    {
        return parent::get((int) $primaryKey, $relations, $fill);
    }
}
