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
 * Risk object mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class RiskObjectMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var   array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'riskmngmt_risk_object_id'             => ['name' => 'riskmngmt_risk_object_id', 'type' => 'int', 'internal' => 'id'],
        'riskmngmt_risk_object_name'           => ['name' => 'riskmngmt_risk_object_name', 'type' => 'string', 'internal' => 'title'],
        'riskmngmt_risk_object_description'    => ['name' => 'riskmngmt_risk_object_description', 'type' => 'string', 'internal' => 'description'],
        'riskmngmt_risk_object_descriptionraw' => ['name' => 'riskmngmt_risk_object_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_risk_object_risk'           => ['name' => 'riskmngmt_risk_object_risk', 'type' => 'int', 'internal' => 'risk'],
    ];

    /**
     * Belongs to.
     *
     * @var   array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'unit' => [
            'mapper' => RiskMapper::class,
            'dest'   => 'riskmngmt_risk_object_risk',
        ],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'riskmngmt_risk_object';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'riskmngmt_risk_object_id';
}
