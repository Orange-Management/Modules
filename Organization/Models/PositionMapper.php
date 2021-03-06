<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Organization\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Organization\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Organization position mapper class.
 *
 * @package Modules\Organization\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class PositionMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'organization_position_id'             => ['name' => 'organization_position_id',             'type' => 'int',    'internal' => 'id'],
        'organization_position_name'           => ['name' => 'organization_position_name',           'type' => 'string', 'internal' => 'name'],
        'organization_position_description'    => ['name' => 'organization_position_description',    'type' => 'string', 'internal' => 'description'],
        'organization_position_descriptionraw' => ['name' => 'organization_position_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'organization_position_parent'         => ['name' => 'organization_position_parent',         'type' => 'int',    'internal' => 'parent'],
        'organization_position_department'     => ['name' => 'organization_position_department',     'type' => 'int',    'internal' => 'department'],
        'organization_position_status'         => ['name' => 'organization_position_status',         'type' => 'int',    'internal' => 'status'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'parent'     => [
            'mapper' => self::class,
            'self'   => 'organization_position_parent',
        ],
        'department' => [
            'mapper' => DepartmentMapper::class,
            'self'   => 'organization_position_department',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'organization_position';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'organization_position_id';
}
