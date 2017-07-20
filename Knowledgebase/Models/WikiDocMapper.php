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
namespace Modules\Knowledgebase\Models;

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
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class WikiDocMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $columns = [
        'wiki_article_id'      => ['name' => 'wiki_article_id', 'type' => 'int', 'internal' => 'id'],
        'wiki_article_title'   => ['name' => 'wiki_article_title', 'type' => 'string', 'internal' => 'name'],
        'wiki_article_language'   => ['name' => 'wiki_article_language', 'type' => 'string', 'internal' => 'language'],
        'wiki_article_doc'    => ['name' => 'wiki_article_doc', 'type' => 'string', 'internal' => 'doc'],
        'wiki_article_status'  => ['name' => 'wiki_article_status', 'type' => 'int', 'internal' => 'status'],
        'wiki_article_category'  => ['name' => 'wiki_article_category', 'type' => 'int', 'internal' => 'category'],
        'wiki_article_created_by' => ['name' => 'wiki_article_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'wiki_article_created_at' => ['name' => 'wiki_article_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $hasMany = [
        'badges' => [
            'mapper'         => WikiBadgeMapper::class,
            'table'          => 'wiki_article_badge',
            'src'            => 'wiki_article_badge_badge',
            'dst'            => 'wiki_article_badge_article',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'category' => [
            'mapper'         => WikiCategoryMapper::class,
            'dst'            => 'wiki_article_category',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'wiki_article';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'wiki_article_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'wiki_article_id';

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
                  ->values($obj->getCreatedBy(), 'task', 'task', 1, $objId, 1, 1, 1, 1, 1);

            self::$db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            return false;
        }

        return $objId;
    }

}
