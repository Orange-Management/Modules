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
 * Risk cause mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class CauseMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'riskmngmt_cause_id'             => ['name' => 'riskmngmt_cause_id',             'type' => 'int',    'internal' => 'id'],
        'riskmngmt_cause_name'           => ['name' => 'riskmngmt_cause_name',           'type' => 'string', 'internal' => 'title'],
        'riskmngmt_cause_description'    => ['name' => 'riskmngmt_cause_description',    'type' => 'string', 'internal' => 'description'],
        'riskmngmt_cause_descriptionraw' => ['name' => 'riskmngmt_cause_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_cause_department'     => ['name' => 'riskmngmt_cause_department',     'type' => 'int',    'internal' => 'department'],
        'riskmngmt_cause_category'       => ['name' => 'riskmngmt_cause_category',       'type' => 'int',    'internal' => 'category'],
        'riskmngmt_cause_risk'           => ['name' => 'riskmngmt_cause_risk',           'type' => 'int',    'internal' => 'risk'],
        'riskmngmt_cause_probability'    => ['name' => 'riskmngmt_cause_probability',    'type' => 'int',    'internal' => 'probability'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'risk'       => [
            'mapper' => RiskMapper::class,
            'self'   => 'riskmngmt_cause_risk',
        ],
        'category'   => [
            'mapper' => CategoryMapper::class,
            'self'   => 'riskmngmt_cause_category',
        ],
        'department' => [
            'mapper' => DepartmentMapper::class,
            'self'   => 'riskmngmt_cause_department',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'riskmngmt_cause';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'riskmngmt_cause_id';
}
