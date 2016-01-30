<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\News\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;

class NewsArticleMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    static protected $columns = [
        'news_id'         => ['name' => 'news_id', 'type' => 'int', 'internal' => 'id'],
        'news_created_by' => ['name' => 'news_created_by', 'type' => 'string', 'internal' => 'createdBy'],
        'news_publish'    => ['name' => 'news_publish', 'type' => 'DateTime', 'internal' => 'publish'],
        'news_title'      => ['name' => 'news_title', 'type' => 'string', 'internal' => 'title'],
        'news_content'    => ['name' => 'news_content', 'type' => 'string', 'internal' => 'content'],
        'news_lang'       => ['name' => 'news_lang', 'type' => 'string', 'internal' => 'language'],
        'news_status'     => ['name' => 'news_status', 'type' => 'int', 'internal' => 'status'],
        'news_type'       => ['name' => 'news_type', 'type' => 'int', 'internal' => 'type'],
        'news_featured'   => ['name' => 'news_featured', 'type' => 'bool', 'internal' => 'featured'],
        'news_created_at' => ['name' => 'news_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
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
     * Create article.
     *
     * @param mixed $obj News article
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function create($obj)
    {
        try {
            $objId = parent::create($obj);
            $query = new Builder($this->db);
            $query->prefix($this->db->getPrefix())
                  ->insert(
                      'account_permission_account',
                      'account_permission_from',
                      'account_permission_for',
                      'account_permission_id1',
                      'account_permission_id2',
                      'account_permission_r',
                      'account_permission_w',
                      'account_permission_m',
                      'account_permission_d',
                      'account_permission_p'
                  )
                  ->into('account_permission')
                  ->values($obj->getCreatedBy(), 'news', 'news', 1, $objId, 1, 1, 1, 1, 1);

            $this->db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
            return false;
        }

        return $objId;
    }

    /**
     * Find.
     *
     * @param array $columns Columns to select
     *
     * @return Builder
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function find(...$columns) : Builder
    {
        return parent::find(...$columns)->from('account_permission')
                     ->where('account_permission.account_permission_for', '=', 'news')
                     ->where('account_permission.account_permission_id1', '=', 1)
                     ->where('news.news_id', '=', new Column('account_permission.account_permission_id2'))
                     ->where('account_permission.account_permission_r', '=', 1);
    }
}
