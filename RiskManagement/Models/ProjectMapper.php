<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Risk project mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ProjectMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'riskmngmt_project_id'          => ['name' => 'riskmngmt_project_id',          'type' => 'int', 'internal' => 'id'],
        'riskmngmt_project_project'     => ['name' => 'riskmngmt_project_project',     'type' => 'int', 'internal' => 'project'],
        'riskmngmt_project_responsible' => ['name' => 'riskmngmt_project_responsible', 'type' => 'int', 'internal' => 'responsible'],
        'riskmngmt_project_deputy'      => ['name' => 'riskmngmt_project_deputy',      'type' => 'int', 'internal' => 'deputy'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'riskmngmt_project';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'riskmngmt_project_id';

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'project' => [
            'mapper' => \Modules\ProjectManagement\Models\ProjectMapper::class,
            'self'   => 'riskmngmt_project_project',
        ],
    ];
}
