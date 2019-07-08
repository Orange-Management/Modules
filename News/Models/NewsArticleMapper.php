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
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\News\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * News mapper class.
 *
 * @package    Modules\News
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class NewsArticleMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'news_id'         => ['name' => 'news_id', 'type' => 'int', 'internal' => 'id'],
        'news_created_by' => ['name' => 'news_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'news_publish'    => ['name' => 'news_publish', 'type' => 'DateTime', 'internal' => 'publish'],
        'news_title'      => ['name' => 'news_title', 'type' => 'string', 'internal' => 'title'],
        'news_plain'      => ['name' => 'news_plain', 'type' => 'string', 'internal' => 'plain'],
        'news_content'    => ['name' => 'news_content', 'type' => 'string', 'internal' => 'content'],
        'news_lang'       => ['name' => 'news_lang', 'type' => 'string', 'internal' => 'language'],
        'news_status'     => ['name' => 'news_status', 'type' => 'int', 'internal' => 'status'],
        'news_type'       => ['name' => 'news_type', 'type' => 'int', 'internal' => 'type'],
        'news_featured'   => ['name' => 'news_featured', 'type' => 'bool', 'internal' => 'featured'],
        'news_created_at' => ['name' => 'news_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
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
            'src'    => 'news_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'news';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'news_id';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'news_created_at';
}
