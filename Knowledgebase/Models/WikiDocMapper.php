<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Knowledgebase\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package    Modules\Knowledgebase\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class WikiDocMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'wiki_article_id'         => ['name' => 'wiki_article_id', 'type' => 'int', 'internal' => 'id'],
        'wiki_article_title'      => ['name' => 'wiki_article_title', 'type' => 'string', 'internal' => 'name'],
        'wiki_article_language'   => ['name' => 'wiki_article_language', 'type' => 'string', 'internal' => 'language'],
        'wiki_article_doc'        => ['name' => 'wiki_article_doc', 'type' => 'string', 'internal' => 'doc'],
        'wiki_article_status'     => ['name' => 'wiki_article_status', 'type' => 'int', 'internal' => 'status'],
        'wiki_article_category'   => ['name' => 'wiki_article_category', 'type' => 'int', 'internal' => 'category'],
        'wiki_article_created_by' => ['name' => 'wiki_article_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'wiki_article_created_at' => ['name' => 'wiki_article_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */
    /*
    protected static $hasMany = [
        'badges' => [
            'mapper' => BadgeMapper::class,
            'table'  => 'wiki_article_badge',
            'src'    => 'wiki_article_badge_badge',
            'dst'    => 'wiki_article_badge_article',
        ],
    ];*/

    /**
     * Has many relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'category' => [
            'mapper' => WikiCategoryMapper::class,
            'dst'    => 'wiki_article_category',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'wiki_article';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'wiki_article_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'wiki_article_id';
}
