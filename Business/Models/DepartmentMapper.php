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

class DepartmentMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected static $columns = [
        'business_department_id'          => ['name' => 'business_department_id', 'type' => 'int', 'internal' => 'id'],
        'business_department_name'        => ['name' => 'business_department_name', 'type' => 'string', 'internal' => 'name'],
        'business_department_description' => ['name' => 'business_department_description', 'type' => 'string', 'internal' => 'description'],
        'business_department_parent'      => ['name' => 'business_department_parent', 'type' => 'int', 'internal' => 'parent'],
        'business_department_unit'        => ['name' => 'business_department_unit', 'type' => 'int', 'internal' => 'unit'],
    ];

    /**
     * Primary table.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $table = 'business_department';

    /**
     * Primary field name.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $primaryField = 'business_department_id';
}
