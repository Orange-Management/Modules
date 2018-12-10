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
 * Organization unit mapper class.
 *
 * @package    Modules\Organization
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class UnitMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'organization_unit_id'             => ['name' => 'organization_unit_id', 'type' => 'int', 'internal' => 'id'],
        'organization_unit_name'           => ['name' => 'organization_unit_name', 'type' => 'string', 'internal' => 'name'],
        'organization_unit_description'    => ['name' => 'organization_unit_description', 'type' => 'string', 'internal' => 'description'],
        'organization_unit_descriptionraw' => ['name' => 'organization_unit_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'organization_unit_parent'         => ['name' => 'organization_unit_parent', 'type' => 'int', 'internal' => 'parent'],
        'organization_unit_status'         => ['name' => 'organization_unit_status', 'type' => 'int', 'internal' => 'status'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $belongsTo = [
        'unit' => [
            'mapper' => UnitMapper::class,
            'dest'   => 'organization_uni_parent',
        ],
        'parent'  => [
            'mapper' => UnitMapper::class,
            'dest'   => 'organization_unit_parent',
        ],
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
}
