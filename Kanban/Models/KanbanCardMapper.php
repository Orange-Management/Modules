<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Kanban\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Kanban\Models;

use Modules\Admin\Models\AccountMapper;
use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Kanban\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class KanbanCardMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'kanban_card_id'          => ['name' => 'kanban_card_id',          'type' => 'int',      'internal' => 'id'],
        'kanban_card_name'        => ['name' => 'kanban_card_name',        'type' => 'string',   'internal' => 'name'],
        'kanban_card_description' => ['name' => 'kanban_card_description', 'type' => 'string',   'internal' => 'description'],
        'kanban_card_type'        => ['name' => 'kanban_card_type',        'type' => 'int',      'internal' => 'type'],
        'kanban_card_status'      => ['name' => 'kanban_card_status',      'type' => 'int',      'internal' => 'status'],
        'kanban_card_order'       => ['name' => 'kanban_card_order',       'type' => 'int',      'internal' => 'order'],
        'kanban_card_ref'         => ['name' => 'kanban_card_ref',         'type' => 'int',      'internal' => 'ref'],
        'kanban_card_column'      => ['name' => 'kanban_card_column',      'type' => 'int',      'internal' => 'column'],
        'kanban_card_created_at'  => ['name' => 'kanban_card_created_at',  'type' => 'DateTime', 'internal' => 'createdAt', 'readonly' => true],
        'kanban_card_created_by'  => ['name' => 'kanban_card_created_by',  'type' => 'int',      'internal' => 'createdBy', 'readonly' => true],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'self'   => 'kanban_card_created_by',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'media'    => [
            'mapper' => MediaMapper::class,
            'table'  => 'kanban_card_media',
            'external' => 'kanban_card_media_dst',
            'self'   => 'kanban_card_media_src',
        ],
        'comments' => [
            'mapper' => KanbanCardCommentMapper::class,
            'table'  => 'kanban_card_comment',
            'external' => 'kanban_card_comment_card',
            'self'   => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'kanban_card';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'kanban_card_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'kanban_card_id';
}
