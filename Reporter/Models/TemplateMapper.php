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
namespace Modules\Reporter\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;

class TemplateMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'reporter_template_id'      => ['name' => 'reporter_template_id', 'type' => 'int', 'internal' => 'id'],
        'reporter_template_status'  => ['name' => 'reporter_template_status', 'type' => 'int', 'internal' => 'status'],
        'reporter_template_title'   => ['name' => 'reporter_template_title', 'type' => 'string', 'internal' => 'name'],
        'reporter_template_data'   => ['name' => 'reporter_template_data', 'type' => 'int', 'internal' => 'datatype'],
        'reporter_template_desc'    => ['name'     => 'reporter_template_desc', 'type' => 'string',
                                        'internal' => 'description'],
        'reporter_template_media'   => ['name' => 'reporter_template_media', 'type' => 'int', 'internal' => 'source'],
        'reporter_template_creator' => ['name'     => 'reporter_template_creator', 'type' => 'int',
                                        'internal' => 'createdBy'],
        'reporter_template_created' => ['name'     => 'reporter_template_created', 'type' => 'DateTime',
                                        'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $table = 'reporter_template';

    protected static $createdAt = 'reporter_template_created';

    /**
     * Primary field name.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $primaryField = 'reporter_template_id';

    /**
     * Create template.
     *
     * @param Template $obj Report template
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
                ->values($obj->getCreatedBy(), 'reporter', 'reporter', 2, $objId, 1, 1, 1, 1, 1);

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
            ->where('account_permission.account_permission_for', '=', 'reporter')
            ->where('account_permission.account_permission_id1', '=', 2)
            ->where('reporter_template.reporter_template_id', '=', new Column('account_permission.account_permission_id2'))
            ->where('account_permission.account_permission_r', '=', 1);
    }
}
