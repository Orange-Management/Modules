<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Comments\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Comments\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package    Modules\Comments\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class CommentMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'comments_comment_id'          => ['name' => 'comments_comment_id', 'type' => 'int', 'internal' => 'id'],
        'comments_comment_title'       => ['name' => 'comments_comment_title', 'type' => 'string', 'internal' => 'title'],
        'comments_comment_status'      => ['name' => 'comments_comment_status', 'type' => 'int', 'internal' => 'status'],
        'comments_comment_content'     => ['name' => 'comments_comment_content', 'type' => 'string', 'internal' => 'content'],
        'comments_comment_content_raw' => ['name' => 'comments_comment_content_raw', 'type' => 'string', 'internal' => 'contentRaw'],
        'comments_comment_list'        => ['name' => 'comments_comment_list', 'type' => 'int', 'internal' => 'list'],
        'comments_comment_ref'         => ['name' => 'comments_comment_ref', 'type' => 'int', 'internal' => 'ref'],
        'comments_comment_created_by'  => ['name' => 'comments_comment_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'comments_comment_created_at'  => ['name' => 'comments_comment_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'comments_comment';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'comments_comment_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'comments_comment_id';
}
