<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Comments\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

/**
 * Mapper class.
 *
 * @package    Tasks
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class CommentMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $columns = [
        'comments_comment_id'      => ['name' => 'comments_comment_id', 'type' => 'int', 'internal' => 'id'],
        'comments_comment_title'   => ['name' => 'comments_comment_title', 'type' => 'string', 'internal' => 'title'],
        'comments_comment_content'    => ['name' => 'comments_comment_content', 'type' => 'string', 'internal' => 'content'],
        'comments_comment_list'    => ['name' => 'comments_comment_list', 'type' => 'int', 'internal' => 'list'],
        'comments_comment_ref'    => ['name' => 'comments_comment_ref', 'type' => 'int', 'internal' => 'ref'],
        'comments_comment_created_by' => ['name' => 'comments_comment_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'comments_comment_created_at' => ['name' => 'comments_comment_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
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
