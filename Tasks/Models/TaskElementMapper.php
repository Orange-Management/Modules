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
use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Tasks\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class TaskElementMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var   array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'task_element_id'         => ['name' => 'task_element_id',         'type' => 'int',      'internal' => 'id'],
        'task_element_desc'       => ['name' => 'task_element_desc',       'type' => 'string',   'internal' => 'description'],
        'task_element_desc_raw'   => ['name' => 'task_element_desc_raw',   'type' => 'string',   'internal' => 'descriptionRaw'],
        'task_element_status'     => ['name' => 'task_element_status',     'type' => 'int',      'internal' => 'status'],
        'task_element_priority'   => ['name' => 'task_element_priority',   'type' => 'int',      'internal' => 'priority'],
        'task_element_due'        => ['name' => 'task_element_due',        'type' => 'DateTime', 'internal' => 'due'],
        'task_element_task'       => ['name' => 'task_element_task',       'type' => 'int',      'internal' => 'task'],
        'task_element_created_by' => ['name' => 'task_element_created_by', 'type' => 'int',      'internal' => 'createdBy'],
        'task_element_created_at' => ['name' => 'task_element_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var   array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'media' => [
            'mapper' => MediaMapper::class,
            'table'  => 'task_element_media',
            'dst'    => 'task_element_media_src',
            'src'    => 'task_element_media_dst',
        ],
        'accRelation'          => [
            'mapper' => AccountRelationMapper::class,
            'table'  => 'task_account',
            'dst'    => 'task_account_task_element',
            'src'    => null,
        ],
        'grpRelation'          => [
            'mapper' => GroupRelationMapper::class,
            'table'  => 'task_group',
            'dst'    => 'task_group_task_element',
            'src'    => null,
        ],
    ];

    /**
     * Belongs to.
     *
     * @var   array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'src'    => 'task_element_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'task_element';

    /**
     * Created at.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $createdAt = 'task_element_created_at';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'task_element_id';
}
