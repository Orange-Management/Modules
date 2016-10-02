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

class PositionMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'organization_position_id'          => ['name' => 'organization_position_id', 'type' => 'int', 'internal' => 'id'],
        'organization_position_name'        => ['name' => 'organization_position_name', 'type' => 'string', 'internal' => 'name'],
        'organization_position_description' => ['name' => 'organization_position_description', 'type' => 'string', 'internal' => 'description'],
        'organization_position_parent'      => ['name' => 'organization_position_parent', 'type' => 'int', 'internal' => 'parent'],
        'organization_position_status'      => ['name' => 'organization_position_status', 'type' => 'int', 'internal' => 'status'],
    ];

    protected static $belongsTo = [
        'account' => [
            'mapper'         => PositionMapper::class,
            'dest'            => 'organization_position_parent',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'organization_position';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'organization_position_id';
}
