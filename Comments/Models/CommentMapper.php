<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Comments\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Comments\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Comments\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class CommentMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'comments_comment_id'          => ['name' => 'comments_comment_id',          'type' => 'int',      'internal' => 'id'],
        'comments_comment_title'       => ['name' => 'comments_comment_title',       'type' => 'string',   'internal' => 'title'],
        'comments_comment_status'      => ['name' => 'comments_comment_status',      'type' => 'int',      'internal' => 'status'],
        'comments_comment_content'     => ['name' => 'comments_comment_content',     'type' => 'string',   'internal' => 'content'],
        'comments_comment_content_raw' => ['name' => 'comments_comment_content_raw', 'type' => 'string',   'internal' => 'contentRaw'],
        'comments_comment_list'        => ['name' => 'comments_comment_list',        'type' => 'int',      'internal' => 'list'],
        'comments_comment_ref'         => ['name' => 'comments_comment_ref',         'type' => 'int',      'internal' => 'ref'],
        'comments_comment_created_by'  => ['name' => 'comments_comment_created_by',  'type' => 'int',      'internal' => 'createdBy'],
        'comments_comment_created_at'  => ['name' => 'comments_comment_created_at',  'type' => 'DateTime', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'comments_comment';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'comments_comment_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'comments_comment_id';
}
