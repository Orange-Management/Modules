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

use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

class SolutionMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $columns = [
        'riskmngmt_solution_id'         => ['name' => 'riskmngmt_solution_id', 'type' => 'int', 'internal' => 'id'],
        'riskmngmt_solution_name'     => ['name' => 'riskmngmt_solution_name', 'type' => 'string', 'internal' => 'title'],
        'riskmngmt_solution_description'     => ['name' => 'riskmngmt_solution_description', 'type' => 'string', 'internal' => 'description'],
        'riskmngmt_solution_descriptionraw'     => ['name' => 'riskmngmt_solution_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_solution_probability'     => ['name' => 'riskmngmt_solution_probability', 'type' => 'int', 'internal' => 'probability'],
        'riskmngmt_solution_cause'     => ['name' => 'riskmngmt_solution_cause', 'type' => 'int', 'internal' => 'cause'],
        'riskmngmt_solution_risk'     => ['name' => 'riskmngmt_solution_risk', 'type' => 'int', 'internal' => 'risk'],
    ];

    protected static $belongsTo = [
        'risk' => [
            'mapper'         => RiskMapper::class,
            'dest'            => 'riskmngmt_solution_risk',
        ],
        'cause' => [
            'mapper'         => CauseMapper::class,
            'dest'            => 'riskmngmt_solution_cause',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'riskmngmt_solution';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'riskmngmt_solution_id';

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
                ->values(1, 'riskmngmt_solution', 'riskmngmt_solution', 1, $objId, 1, 1, 1, 1, 1);

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
        return parent::get($primaryKey, $relations, $fill);
    }
}
