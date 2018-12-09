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

namespace Modules\News\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

final class BadgeMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, string|bool>>
     * @since 1.0.0
     */
    static protected $columns = [
        'news_badge_id'    => ['name' => 'news_badge_id', 'type' => 'int', 'internal' => 'id'],
        'news_badge_title' => ['name' => 'news_badge_title', 'type' => 'string', 'internal' => 'title'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'news_badge';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'news_badge_id';
}
