<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tasks\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
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
 * @package Modules\Tasks\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class TaskMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'task_id'         => ['name' => 'task_id',         'type' => 'int',      'internal' => 'id'],
        'task_title'      => ['name' => 'task_title',      'type' => 'string',   'internal' => 'title'],
        'task_desc'       => ['name' => 'task_desc',       'type' => 'string',   'internal' => 'description'],
        'task_desc_raw'   => ['name' => 'task_desc_raw',   'type' => 'string',   'internal' => 'descriptionRaw'],
        'task_type'       => ['name' => 'task_type',       'type' => 'int',      'internal' => 'type'],
        'task_status'     => ['name' => 'task_status',     'type' => 'int',      'internal' => 'status'],
        'task_closable'   => ['name' => 'task_closable',   'type' => 'bool',     'internal' => 'isClosable'],
        'task_editable'   => ['name' => 'task_editable',   'type' => 'bool',     'internal' => 'isEditable'],
        'task_priority'   => ['name' => 'task_priority',   'type' => 'int',      'internal' => 'priority'],
        'task_due'        => ['name' => 'task_due',        'type' => 'DateTime', 'internal' => 'due'],
        'task_done'       => ['name' => 'task_done',       'type' => 'DateTime', 'internal' => 'done'],
        'task_schedule'   => ['name' => 'task_schedule',   'type' => 'int',      'internal' => 'schedule'],
        'task_start'      => ['name' => 'task_start',      'type' => 'DateTime', 'internal' => 'start'],
        'task_created_by' => ['name' => 'task_created_by', 'type' => 'int',      'internal' => 'createdBy'],
        'task_created_at' => ['name' => 'task_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $hasMany = [
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
        'tags'        => [
            'mapper' => MediaMapper::class,
            'table'  => 'task_tag',
            'dst'    => 'task_tag_src',
            'src'    => 'task_tag_dst',
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
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
    protected static array $ownsOne = [
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
    protected static string $table = 'task';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'task_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'task_id';

    /**
     * Get open tasks by createdBy
     *
     * @param int $user User
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public static function getOpenCreatedBy(int $user) : array
    {
        $query = self::getQuery();
        $query->where(self::$table . '.task_created_by', '=', $user)
            ->where(self::$table . '.task_status', '=', TaskStatus::OPEN);

        return self::getAllByQuery($query);
    }

    /**
     * Get open tasks for user
     *
     * @param int $user User
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public static function getOpenTo(int $user) : array
    {
        $query = self::getQuery();
        $query->innerJoin(TaskElementMapper::getTable())
                ->on(self::$table . '.task_id', '=', TaskElementMapper::getTable() . '.task_element_task')
            ->innerJoin(AccountRelationMapper::getTable())
                ->on(TaskElementMapper::getTable() . '.task_element_id', '=', AccountRelationMapper::getTable() . '.task_account_task_element')
            ->where(self::$table . '.task_status', '=', TaskStatus::OPEN)
            ->andWhere(AccountRelationMapper::getTable() . '.task_account_account', '=', $user)
            ->andWhere(AccountRelationMapper::getTable() . '.task_account_duty', '=', DutyType::TO);

        return self::getAllByQuery($query);
    }

    /**
     * Get open tasks for mentioned user
     *
     * @param int $user User
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public static function getOpenAny(int $user) : array
    {
        $query = self::getQuery();
        $query->innerJoin(TaskElementMapper::getTable())
                ->on(self::$table . '.task_id', '=', TaskElementMapper::getTable() . '.task_element_task')
            ->innerJoin(AccountRelationMapper::getTable())
                ->on(TaskElementMapper::getTable() . '.task_element_id', '=', AccountRelationMapper::getTable() . '.task_account_task_element')
            ->where(self::$table . '.task_status', '=', TaskStatus::OPEN)
            ->andWhere(AccountRelationMapper::getTable() . '.task_account_account', '=', $user);

        return self::getAllByQuery($query);
    }

    /**
     * Get open tasks by cc
     *
     * @param int $user User
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public static function getOpenCC(int $user) : array
    {
        $query = self::getQuery();
        $query->innerJoin(TaskElementMapper::getTable())
                ->on(self::$table . '.task_id', '=', TaskElementMapper::getTable() . '.task_element_task')
            ->innerJoin(AccountRelationMapper::getTable())
                ->on(TaskElementMapper::getTable() . '.task_element_id', '=', AccountRelationMapper::getTable() . '.task_account_task_element')
            ->where(self::$table . '.task_status', '=', TaskStatus::OPEN)
            ->andWhere(AccountRelationMapper::getTable() . '.task_account_account', '=', $user)
            ->andWhere(AccountRelationMapper::getTable() . '.task_account_duty', '=', DutyType::CC);

        return self::getAllByQuery($query);
    }

    /**
     * Get tasks created by user
     *
     * @param int $user User
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public static function getCreatedBy(int $user) : array
    {
        $query = self::getQuery();
        $query->where(self::$table . '.task_created_by', '=', $user);

        return self::getAllByQuery($query);
    }

    /**
     * Get tasks sent to user
     *
     * @param int $user User
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public static function getTo(int $user) : array
    {
        $query = self::getQuery();
        $query->innerJoin(TaskElementMapper::getTable())
                ->on(self::$table . '.task_id', '=', TaskElementMapper::getTable() . '.task_element_task')
            ->innerJoin(AccountRelationMapper::getTable())
                ->on(TaskElementMapper::getTable() . '.task_element_id', '=', AccountRelationMapper::getTable() . '.task_account_task_element')
            ->where(AccountRelationMapper::getTable() . '.task_account_account', '=', $user)
            ->andWhere(AccountRelationMapper::getTable() . '.task_account_duty', '=', DutyType::TO);

        return self::getAllByQuery($query);
    }

    /**
     * Get tasks cc to user
     *
     * @param int $user User
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public static function getCC(int $user) : array
    {
        $query = self::getQuery();
        $query->innerJoin(TaskElementMapper::getTable())
                ->on(self::$table . '.task_id', '=', TaskElementMapper::getTable() . '.task_element_task')
            ->innerJoin(AccountRelationMapper::getTable())
                ->on(TaskElementMapper::getTable() . '.task_element_id', '=', AccountRelationMapper::getTable() . '.task_account_task_element')
            ->where(AccountRelationMapper::getTable() . '.task_account_account', '=', $user)
            ->andWhere(AccountRelationMapper::getTable() . '.task_account_duty', '=', DutyType::CC);

        return self::getAllByQuery($query);
    }

    /**
     * Get tasks that have something to do with the user
     *
     * @param int $user User
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public static function getAny(int $user) : array
    {
        $query = self::getQuery();
        $query->innerJoin(TaskElementMapper::getTable())
                ->on(self::$table . '.task_id', '=', TaskElementMapper::getTable() . '.task_element_task')
            ->innerJoin(AccountRelationMapper::getTable())
                ->on(TaskElementMapper::getTable() . '.task_element_id', '=', AccountRelationMapper::getTable() . '.task_account_task_element')
            ->where(AccountRelationMapper::getTable() . '.task_account_account', '=', $user)
            ->orWhere(self::getTable() . '.task_created_by', '=', $user)
            ->orderBy(TaskElementMapper::getTable() . '.' . TaskElementMapper::getCreatedAt(), 'DESC');

        return self::getAllByQuery($query);
    }

    /**
     * Count unread task
     *
     * @param int $user User
     *
     * @return int
     *
     * @since 1.0.0
     */
    public static function countUnread(int $user) : int
    {
        try {
            $query = new Builder(self::$db);

            $query->prefix(self::$db->getPrefix())
                ->count('*')
                ->from(self::$table)
                ->innerJoin(TaskElementMapper::getTable())
                    ->on(self::$table . '.task_id', '=', TaskElementMapper::getTable() . '.task_element_task')
                ->innerJoin(AccountRelationMapper::getTable())
                    ->on(TaskElementMapper::getTable() . '.task_element_id', '=', AccountRelationMapper::getTable() . '.task_account_task_element')
                ->where(self::$table . '.task_status', '=', TaskStatus::OPEN)
                ->andWhere(AccountRelationMapper::getTable() . '.task_account_account', '=', $user);

            $sth = self::$db->con->prepare($query->toSql());
            $sth->execute();

            $count = $sth->fetchAll()[0][0] ?? 0;
        } catch (\Exception $e) {
            return -1;
        }

        return $count;
    }
}
