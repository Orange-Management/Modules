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
namespace Modules\Kanban\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;
use Modules\Media\Models\MediaMapper;

/**
 * Mapper class.
 *
 * @category   Tasks
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class KanbanCardMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $columns = [
        'kanban_card_id'      => ['name' => 'kanban_card_id', 'type' => 'int', 'internal' => 'id'],
        'kanban_card_name'   => ['name' => 'kanban_card_name', 'type' => 'string', 'internal' => 'name'],
        'kanban_card_description'   => ['name' => 'kanban_card_description', 'type' => 'string', 'internal' => 'description'],
        'kanban_card_type'    => ['name' => 'kanban_card_type', 'type' => 'int', 'internal' => 'type'],
        'kanban_card_status'    => ['name' => 'kanban_card_status', 'type' => 'int', 'internal' => 'status'],
        'kanban_card_order'    => ['name' => 'kanban_card_order', 'type' => 'int', 'internal' => 'order'],
        'kanban_card_ref'    => ['name' => 'kanban_card_ref', 'type' => 'int', 'internal' => 'ref'],
        'kanban_card_column'    => ['name' => 'kanban_card_column', 'type' => 'int', 'internal' => 'column'],
        'kanban_card_created_at'  => ['name' => 'kanban_card_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
        'kanban_card_created_by'  => ['name' => 'kanban_card_created_by', 'type' => 'int', 'internal' => 'createdBy'],
    ];

    /**
     * Has many relation.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $hasMany = [
        'media' => [
            'mapper'         => MediaMapper::class,
            'table'          => 'kanban_card_media',
            'dst'            => 'kanban_card_media_dst',
            'src'            => 'kanban_card_media_src',
        ],
        'labels' => [
            'mapper'         => KanbanLabelMapper::class,
            'table'          => 'kanban_label_relation',
            'dst'            => 'kanban_label_relation_card',
            'src'            => 'kanban_label_relation_label',
        ],
        'comments' => [
            'mapper'         => KanbanCardCommentMapper::class,
            'table'          => 'kanban_card_comment',
            'dst'            => 'kanban_card_comment_card',
            'src'            => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'kanban_card';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'kanban_card_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'kanban_card_id';

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
                  ->values($obj->getCreatedBy(), 'task', 'task', 1, $objId, 1, 1, 1, 1, 1);

            self::$db->con->prepare($query->toSql())->execute();
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
    public static function find(...$columns) : Builder
    {
        return parent::find(...$columns)->from('account_permission')
                     ->where('account_permission.account_permission_for', '=', 'task')
                     ->where('account_permission.account_permission_id1', '=', 1)
                     ->where('task.task_id', '=', new Column('account_permission.account_permission_id2'))
                     ->where('account_permission.account_permission_r', '=', 1);
    }
}