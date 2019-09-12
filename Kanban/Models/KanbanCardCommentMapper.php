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
final class KanbanCardCommentMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var   array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'kanban_card_comment_id'          => ['name' => 'kanban_card_comment_id', 'type' => 'int', 'internal' => 'id'],
        'kanban_card_comment_description' => ['name' => 'kanban_card_comment_description', 'type' => 'string', 'internal' => 'description'],
        'kanban_card_comment_card'        => ['name' => 'kanban_card_comment_card', 'type' => 'int', 'internal' => 'card'],
        'kanban_card_comment_created_at'  => ['name' => 'kanban_card_comment_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
        'kanban_card_comment_created_by'  => ['name' => 'kanban_card_comment_created_by', 'type' => 'int', 'internal' => 'createdBy'],
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
            'table'  => 'kanban_card_comment_media',
            'dst'    => 'kanban_card_comment_media_dst',
            'src'    => 'kanban_card_comment_media_src',
        ],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'kanban_card_comment';

    /**
     * Created at.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $createdAt = 'kanban_card_comment_created_at';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'kanban_card_comment_id';
}
