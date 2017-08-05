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
namespace Modules\News\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

class BadgeMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array
     * @since 1.0.0
     */
    static protected $columns = [
        'news_badge_id'         => ['name' => 'news_badge_id', 'type' => 'int', 'internal' => 'id'],
        'news_badge_title'      => ['name' => 'news_badge_title', 'type' => 'string', 'internal' => 'title'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'news_badge';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'news_badge_id';

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
                ->values($obj->getCreatedBy(), 'news', 'news', 1, $objId, 1, 1, 1, 1, 1);

            self::$db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
            return false;
        }

        return $objId;
    }

}
