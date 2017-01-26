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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Organization\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

class DepartmentMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'organization_department_id'          => ['name' => 'organization_department_id', 'type' => 'int', 'internal' => 'id'],
        'organization_department_name'        => ['name' => 'organization_department_name', 'type' => 'string', 'internal' => 'name'],
        'organization_department_description' => ['name' => 'organization_department_description', 'type' => 'string', 'internal' => 'description'],
        'organization_department_parent'      => ['name' => 'organization_department_parent', 'type' => 'int', 'internal' => 'parent'],
        'organization_department_unit'        => ['name' => 'organization_department_unit', 'type' => 'int', 'internal' => 'unit'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'organization_department';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'organization_department_id';
}
