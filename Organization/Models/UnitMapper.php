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
namespace Modules\Organization\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

class UnitMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'organization_unit_id'          => ['name' => 'organization_unit_id', 'type' => 'int', 'internal' => 'id'],
        'organization_unit_status'      => ['name' => 'organization_unit_status', 'type' => 'int', 'internal' => 'status'],
        'organization_unit_matchcode'   => ['name' => 'organization_unit_matchcode', 'type' => 'string', 'internal' => 'matchcode'],
        'organization_unit_name'        => ['name' => 'organization_unit_name', 'type' => 'string', 'internal' => 'name'],
        'organization_unit_description' => ['name' => 'organization_unit_description', 'type' => 'string', 'internal' => 'description'],
        'organization_unit_parent'      => ['name' => 'organization_unit_parent', 'type' => 'int', 'internal' => 'parent'],
        'organization_unit_created'     => ['name' => 'organization_unit_created', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'organization_unit';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'organization_unit_id';

    /**
     * Created at column
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'organization_unit_created';
}
