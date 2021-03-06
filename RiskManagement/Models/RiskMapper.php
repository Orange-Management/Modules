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

use Modules\Media\Models\MediaMapper;
use Modules\Organization\Models\UnitMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Risk mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class RiskMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'riskmngmt_risk_id'             => ['name' => 'riskmngmt_risk_id',             'type' => 'int',      'internal' => 'id'],
        'riskmngmt_risk_name'           => ['name' => 'riskmngmt_risk_name',           'type' => 'string',   'internal' => 'name'],
        'riskmngmt_risk_description'    => ['name' => 'riskmngmt_risk_description',    'type' => 'string',   'internal' => 'description'],
        'riskmngmt_risk_descriptionraw' => ['name' => 'riskmngmt_risk_descriptionraw', 'type' => 'string',   'internal' => 'descriptionRaw'],
        'riskmngmt_risk_unit'           => ['name' => 'riskmngmt_risk_unit',           'type' => 'int',      'internal' => 'unit'],
        'riskmngmt_risk_department'     => ['name' => 'riskmngmt_risk_department',     'type' => 'int',      'internal' => 'department'],
        'riskmngmt_risk_category'       => ['name' => 'riskmngmt_risk_category',       'type' => 'int',      'internal' => 'category'],
        'riskmngmt_risk_project'        => ['name' => 'riskmngmt_risk_project',        'type' => 'int',      'internal' => 'project'],
        'riskmngmt_risk_process'        => ['name' => 'riskmngmt_risk_process',        'type' => 'int',      'internal' => 'process'],
        'riskmngmt_risk_responsible'    => ['name' => 'riskmngmt_risk_responsible',    'type' => 'int',      'internal' => 'responsible'],
        'riskmngmt_risk_deputy'         => ['name' => 'riskmngmt_risk_deputy',         'type' => 'int',      'internal' => 'deputy'],
        'riskmngmt_risk_created_at'     => ['name' => 'riskmngmt_risk_created_at',     'type' => 'DateTime', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'media'       => [
            'mapper' => MediaMapper::class,
            'table'  => 'riskmngmt_risk_media',
            'external' => 'riskmngmt_risk_media_risk',
            'self'   => 'riskmngmt_risk_media_media',
        ],
        'riskObjects' => [
            'mapper' => RiskObjectMapper::class,
            'table'  => 'riskmngmt_risk_object',
            'external' => 'riskmngmt_risk_object_risk',
            'self'   => null,
        ],
        'causes'      => [
            'mapper' => CauseMapper::class,
            'table'  => 'riskmngmt_cause',
            'external' => 'riskmngmt_cause_risk',
            'self'   => null,
        ],
        'solutions'   => [
            'mapper' => SolutionMapper::class,
            'table'  => 'riskmngmt_solution',
            'external' => 'riskmngmt_solution_risk',
            'self'   => null,
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'project'    => [
            'mapper' => ProjectMapper::class,
            'self'   => 'riskmngmt_risk_project',
        ],
        'process'    => [
            'mapper' => ProcessMapper::class,
            'self'   => 'riskmngmt_risk_process',
        ],
        'category'   => [
            'mapper' => CategoryMapper::class,
            'self'   => 'riskmngmt_risk_category',
        ],
        'department' => [
            'mapper' => DepartmentMapper::class,
            'self'   => 'riskmngmt_risk_department',
        ],
        'unit'       => [
            'mapper' => UnitMapper::class,
            'self'   => 'riskmngmt_risk_unit',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'riskmngmt_risk';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'riskmngmt_risk_id';
}
