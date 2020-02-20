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
 * Risk solution mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class SolutionMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'riskmngmt_solution_id'             => ['name' => 'riskmngmt_solution_id',             'type' => 'int',    'internal' => 'id'],
        'riskmngmt_solution_name'           => ['name' => 'riskmngmt_solution_name',           'type' => 'string', 'internal' => 'title'],
        'riskmngmt_solution_description'    => ['name' => 'riskmngmt_solution_description',    'type' => 'string', 'internal' => 'description'],
        'riskmngmt_solution_descriptionraw' => ['name' => 'riskmngmt_solution_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_solution_probability'    => ['name' => 'riskmngmt_solution_probability',    'type' => 'int',    'internal' => 'probability'],
        'riskmngmt_solution_cause'          => ['name' => 'riskmngmt_solution_cause',          'type' => 'int',    'internal' => 'cause'],
        'riskmngmt_solution_risk'           => ['name' => 'riskmngmt_solution_risk',           'type' => 'int',    'internal' => 'risk'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'risk'  => [
            'mapper' => RiskMapper::class,
            'self'   => 'riskmngmt_solution_risk',
        ],
        'cause' => [
            'mapper' => CauseMapper::class,
            'self'   => 'riskmngmt_solution_cause',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'riskmngmt_solution';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'riskmngmt_solution_id';
}
