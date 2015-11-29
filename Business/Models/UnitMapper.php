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
namespace Modules\Business\Models;

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
        'business_unit_id'          => ['name' => 'business_unit_id', 'type' => 'int', 'internal' => 'id'],
        'business_unit_status'      => ['name' => 'business_unit_status', 'type' => 'int', 'internal' => 'status'],
        'business_unit_matchcode'   => ['name' => 'business_unit_matchcode', 'type' => 'string', 'internal' => 'matchcode'],
        'business_unit_name'        => ['name' => 'business_unit_name', 'type' => 'string', 'internal' => 'name'],
        'business_unit_description' => ['name' => 'business_unit_description', 'type' => 'string', 'internal' => 'description'],
        'business_unit_parent'      => ['name' => 'business_unit_parent', 'type' => 'int', 'internal' => 'parent'],
        'business_unit_created'     => ['name' => 'business_unit_created', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $table = 'business_unit';

    /**
     * Primary field name.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $primaryField = 'business_unit_id';

    /**
     * Created at column
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $createdAt = 'business_unit_created';
}
