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
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Editor\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

class EditorDocMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array
     * @since 1.0.0
     */
    static protected $columns = [
        'editor_doc_id'         => ['name' => 'editor_doc_id', 'type' => 'int', 'internal' => 'id'],
        'editor_doc_created_by' => ['name' => 'editor_doc_created_by', 'type' => 'string', 'internal' => 'createdBy'],
        'editor_doc_title'      => ['name' => 'editor_doc_title', 'type' => 'string', 'internal' => 'title'],
        'editor_doc_plain'    => ['name' => 'editor_doc_plain', 'type' => 'string', 'internal' => 'plain'],
        'editor_doc_content'    => ['name' => 'editor_doc_content', 'type' => 'string', 'internal' => 'content'],
        'editor_doc_path'       => ['name' => 'editor_doc_path', 'type' => 'string', 'internal' => 'path'],
        'editor_doc_created_at' => ['name' => 'editor_doc_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    static protected $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'src'    => 'editor_doc_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'editor_doc';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'editor_doc_id';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'editor_doc_created_at';

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
                ->values($obj->getCreatedBy(), 'editor', 'editor', 1, $objId, 1, 1, 1, 1, 1);

            self::$db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
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
            ->where('account_permission.account_permission_for', '=', 'editor')
            ->where('account_permission.account_permission_id1', '=', 1)
            ->where('news.news_id', '=', new Column('account_permission.account_permission_id2'))
            ->where('account_permission.account_permission_r', '=', 1);
    }
}
