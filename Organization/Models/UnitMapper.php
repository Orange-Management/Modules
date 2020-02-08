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
 * Organization unit mapper class.
 *
 * @package Modules\Organization\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class UnitMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'organization_unit_id'             => ['name' => 'organization_unit_id',             'type' => 'int',    'internal' => 'id'],
        'organization_unit_name'           => ['name' => 'organization_unit_name',           'type' => 'string', 'internal' => 'name'],
        'organization_unit_description'    => ['name' => 'organization_unit_description',    'type' => 'string', 'internal' => 'description'],
        'organization_unit_descriptionraw' => ['name' => 'organization_unit_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'organization_unit_parent'         => ['name' => 'organization_unit_parent',         'type' => 'int',    'internal' => 'parent'],
        'organization_unit_status'         => ['name' => 'organization_unit_status',         'type' => 'int',    'internal' => 'status'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'parent'  => [
            'mapper' => self::class,
            'self'   => 'organization_unit_parent',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'organization_unit';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'organization_unit_id';
}
