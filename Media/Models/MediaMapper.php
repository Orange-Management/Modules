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
namespace Modules\Media\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;

class MediaMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'media_id'         => ['name' => 'media_id', 'type' => 'int', 'internal' => 'id'],
        'media_name'       => ['name' => 'media_name', 'type' => 'string', 'internal' => 'name'],
        'media_versioned'  => ['name' => 'media_versioned', 'type' => 'bool', 'internal' => 'versioned'],
        'media_file'       => ['name' => 'media_file', 'type' => 'string', 'internal' => 'path'],
        'media_extension'  => ['name' => 'media_extension', 'type' => 'string', 'internal' => 'extension'],
        'media_collection' => ['name' => 'media_collection', 'type' => 'bool', 'internal' => 'collection'],
        'media_size'       => ['name' => 'media_size', 'type' => 'int', 'internal' => 'size'],
        'media_created_by' => ['name' => 'media_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'media_created_at' => ['name' => 'media_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $table = 'media';

    protected static $createdAt = 'media_created_at';

    /**
     * Primary field name.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $primaryField = 'media_id';

    /**
     * Create media.
     *
     * @param Media $obj Media
     *
     * @return \bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function create(&$obj)
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
                  ->values($obj->getCreatedBy(), 'media', 'media', 1, $objId, 1, 1, 1, 1, 1);

            $this->db->con->prepare($query->toSql())->execute();
        } catch (\Exception $e) {
            var_dump($e);

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
                     ->where('account_permission.account_permission_for', '=', 'media')
                     ->where('account_permission.account_permission_id1', '=', 1)
                     ->where('media.media_id', '=', new Column('account_permission.account_permission_id2'))
                     ->where('account_permission.account_permission_r', '=', 1);
    }
}
