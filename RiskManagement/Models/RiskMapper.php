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
     * @var   array<string, array<string, bool|string>>
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
        'riskmngmt_risk_created_at'     => ['name' => 'riskmngmt_risk_created_at',     'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var   array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'media'       => [
            'mapper' => MediaMapper::class,
            'table'  => 'riskmngmt_risk_media',
            'dst'    => 'riskmngmt_risk_media_risk',
            'src'    => 'riskmngmt_risk_media_media',
        ],
        'riskObjects' => [
            'mapper' => RiskObjectMapper::class,
            'table'  => 'riskmngmt_risk_object',
            'dst'    => 'riskmngmt_risk_object_risk',
            'src'    => null,
        ],
        'causes'      => [
            'mapper' => CauseMapper::class,
            'table'  => 'riskmngmt_cause',
            'dst'    => 'riskmngmt_cause_risk',
            'src'    => null,
        ],
        'solutions'   => [
            'mapper' => SolutionMapper::class,
            'table'  => 'riskmngmt_solution',
            'dst'    => 'riskmngmt_solution_risk',
            'src'    => null,
        ],
    ];

    /**
     * Belongs to.
     *
     * @var   array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'project'    => [
            'mapper' => ProjectMapper::class,
            'dest'   => 'riskmngmt_risk_project',
        ],
        'process'    => [
            'mapper' => ProcessMapper::class,
            'dest'   => 'riskmngmt_risk_process',
        ],
        'category'   => [
            'mapper' => CategoryMapper::class,
            'dest'   => 'riskmngmt_risk_category',
        ],
        'department' => [
            'mapper' => DepartmentMapper::class,
            'dest'   => 'riskmngmt_risk_department',
        ],
        'unit'       => [
            'mapper' => UnitMapper::class,
            'dest'   => 'riskmngmt_risk_unit',
        ],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'riskmngmt_risk';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'riskmngmt_risk_id';
}
