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
namespace Modules\Tasks\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;

class TaskMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'task_id'      => ['name' => 'task_id', 'type' => 'int', 'internal' => 'id'],
        'task_title'   => ['name' => 'task_title', 'type' => 'string', 'internal' => 'title'],
        'task_desc'    => ['name' => 'task_desc', 'type' => 'string', 'internal' => 'description'],
        'task_plain'   => ['name' => 'task_plain', 'type' => 'string', 'internal' => 'plain'],
        'task_type'    => ['name' => 'task_type', 'type' => 'int', 'internal' => 'type'],
        'task_status'  => ['name' => 'task_status', 'type' => 'int', 'internal' => 'status'],
        'task_due'     => ['name' => 'task_due', 'type' => 'DateTime', 'internal' => 'due'],
        'task_done'    => ['name' => 'task_done', 'type' => 'DateTime', 'internal' => 'done'],
        'task_creator' => ['name' => 'task_creator', 'type' => 'int', 'internal' => 'createdBy'],
        'task_created' => ['name' => 'task_created', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'task';

    protected static $createdAt = 'task_created';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'task_id';

    /**
     * Create media.
     *
     * @param Task $obj Media
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
                  ->values($obj->getCreatedBy(), 'task', 'task', 1, $objId, 1, 1, 1, 1, 1);

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
                     ->where('account_permission.account_permission_for', '=', 'task')
                     ->where('account_permission.account_permission_id1', '=', 1)
                     ->where('task.task_id', '=', new Column('account_permission.account_permission_id2'))
                     ->where('account_permission.account_permission_r', '=', 1);
    }
}
