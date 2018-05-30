<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Organization
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Organization\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Organization department mapper class.
 *
 * @package    Modules\Organization
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class DepartmentMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'organization_department_id'             => ['name' => 'organization_department_id', 'type' => 'int', 'internal' => 'id'],
        'organization_department_name'           => ['name' => 'organization_department_name', 'type' => 'string', 'internal' => 'name'],
        'organization_department_description'    => ['name' => 'organization_department_description', 'type' => 'string', 'internal' => 'description'],
        'organization_department_descriptionraw' => ['name' => 'organization_department_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'organization_department_parent'         => ['name' => 'organization_department_parent', 'type' => 'int', 'internal' => 'parent'],
        'organization_department_status'         => ['name' => 'organization_department_status', 'type' => 'int', 'internal' => 'status'],
        'organization_department_unit'           => ['name' => 'organization_department_unit', 'type' => 'int', 'internal' => 'unit'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $belongsTo = [
        'unit' => [
            'mapper'         => UnitMapper::class,
            'dest'            => 'organization_department_unit',
        ],
        'parent' => [
            'mapper'         => DepartmentMapper::class,
            'dest'            => 'organization_department_parent',
        ],
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
