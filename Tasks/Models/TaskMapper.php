<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Tasks
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Tasks\Models;

use Modules\Admin\Models\AccountMapper;
use Modules\Calendar\Models\ScheduleMapper;
use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;

/**
 * Mapper class.
 *
 * @package    Modules\Tasks
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class TaskMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'task_id'         => ['name' => 'task_id', 'type' => 'int', 'internal' => 'id'],
        'task_title'      => ['name' => 'task_title', 'type' => 'string', 'internal' => 'title'],
        'task_desc'       => ['name' => 'task_desc', 'type' => 'string', 'internal' => 'description'],
        'task_desc_raw'   => ['name' => 'task_desc_raw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'task_type'       => ['name' => 'task_type', 'type' => 'int', 'internal' => 'type'],
        'task_status'     => ['name' => 'task_status', 'type' => 'int', 'internal' => 'status'],
        'task_closable'   => ['name' => 'task_closable', 'type' => 'bool', 'internal' => 'isClosable'],
        'task_priority'   => ['name' => 'task_priority', 'type' => 'int', 'internal' => 'priority'],
        'task_due'        => ['name' => 'task_due', 'type' => 'DateTime', 'internal' => 'due'],
        'task_done'       => ['name' => 'task_done', 'type' => 'DateTime', 'internal' => 'done'],
        'task_schedule'   => ['name' => 'task_schedule', 'type' => 'int', 'internal' => 'schedule'],
        'task_start'      => ['name' => 'task_start', 'type' => 'DateTime', 'internal' => 'start'],
        'task_created_by' => ['name' => 'task_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'task_created_at' => ['name' => 'task_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */    /**
     * Has many relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'taskElements' => [
            'mapper' => TaskElementMapper::class,
            'table'  => 'task_element',
            'dst'    => 'task_element_task',
            'src'    => null,
        ],
        'media'        => [
            'mapper' => MediaMapper::class,
            'table'  => 'task_media',
            'dst'    => 'task_media_src',
            'src'    => 'task_media_dst',
        ],
        'acc'          => [
            'mapper' => AccountMapper::class,
            'table'  => 'task_account',
            'dst'    => 'task_account_account',
            'src'    => 'task_account_task',
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'src'    => 'task_created_by',
        ],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'schedule' => [
            'mapper' => ScheduleMapper::class,
            'src'    => 'task_schedule',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'task';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'task_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'task_id';

    /**
     * Get open tasks
     *
     * @param int $user User
     *
     * @return array
     *
     * @since  1.0.0
     */
    public static function getOpen(int $user) : array
    {
        $query = self::getQuery();
        $query->where(self::$table . '.task_created_by', '=', $user)
            ->where(self::$table . '.task_status', '=', TaskStatus::OPEN);

        return self::getAllByQuery($query);
    }

    /**
     * Get tasks related to user
     *
     * @param int $user  User
     * @param int $limit Result limit
     *
     * @return array
     *
     * @since  1.0.0
     */
    public static function getRelatedToAccount(int $user, int $limit = 25) : array
    {
        $query = self::getQuery();

        $whereClause1 = new Builder(self::$db);
        $whereClause1->prefix(self::$db->getPrefix())
            ->select(TaskElementMapper::getTable() . '.task_element_task')
            ->distinct()
            ->from(TaskElementMapper::getTable())
            ->where(TaskElementMapper::getTable() . '.task_element_created_by', '=', $user)
            ->orWhere(TaskElementMapper::getTable() . '.task_element_forwarded', '=', $user);

        $whereClause2 = new Builder(self::$db);
        $whereClause2->prefix(self::$db->getPrefix())
            ->select(self::$table . '.' . self::$primaryField)
            ->from(self::$table)
            ->where(self::$table . '.task_created_by', '=', $user);

        $query->where(self::$table . '.' . self::$primaryField, 'in', $whereClause1)
            ->orWhere(self::$table. '.' . self::$primaryField, 'in', $whereClause2)
            ->limit($limit);

        return self::getAllByQuery($query);
    }

    /**
     * Count unread task
     *
     * @param int $user User
     *
     * @return int
     *
     * @since  1.0.0
     */
    public static function countUnread(int $user) : int
    {
        try {
            $query = new Builder(self::$db);

            $query->prefix(self::$db->getPrefix())
                ->count()
                ->from(self::$table)
                ->where(self::$table . '.task_created_by', '=', $user)
                ->where(self::$table . '.task_status', '=', TaskStatus::OPEN, 'and');

            $sth = self::$db->con->prepare($query->toSql());
            $sth->execute();

            $count = $sth->fetchAll()[0][0] ?? 0;
        } catch (\Exception $e) {
            return -1;
        }

        return $count;
    }
}
