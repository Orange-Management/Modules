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
namespace Modules\Admin\Models;

use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

class AccountMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $columns = [
        'account_id'         => ['name' => 'account_id', 'type' => 'int', 'internal' => 'id'],
        'account_status'     => ['name' => 'account_status', 'type' => 'int', 'internal' => 'status'],
        'account_type'       => ['name' => 'account_type', 'type' => 'int', 'internal' => 'type'],
        'account_login'    => ['name' => 'account_login', 'type' => 'string', 'internal' => 'login'],
        'account_name1'      => ['name' => 'account_name1', 'type' => 'string', 'internal' => 'name1'],
        'account_name2'      => ['name' => 'account_name2', 'type' => 'string', 'internal' => 'name2'],
        'account_name3'      => ['name' => 'account_name3', 'type' => 'string', 'internal' => 'name3'],
        'account_password' => ['name' => 'account_password', 'type' => 'string', 'internal' => 'password'],
        'account_email'      => ['name' => 'account_email', 'type' => 'string', 'internal' => 'email'],
        //'account_tries'    => ['name' => 'account_tries', 'type' => 'int', 'internal' => 'tries'],
        'account_lactive'    => ['name'     => 'account_lactive', 'type' => 'DateTime',
                                 'internal' => 'lastActive'],
        'account_created_at' => ['name' => 'account_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'account';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'account_id';

    /**
     * Created at column
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'account_created_at';

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
                  ->values(1, 'account', 'account', 1, $objId, 1, 1, 1, 1, 1);

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
     * @return Account
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function get($primaryKey, int $relations = RelationType::ALL, $fill = null)
    {
        return parent::get((int) $primaryKey, $relations, $fill);
    }
}
