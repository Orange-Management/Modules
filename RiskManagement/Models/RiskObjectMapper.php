<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

final class RiskObjectMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'riskmngmt_risk_object_id'             => ['name' => 'riskmngmt_risk_object_id', 'type' => 'int', 'internal' => 'id'],
        'riskmngmt_risk_object_name'           => ['name' => 'riskmngmt_risk_object_name', 'type' => 'string', 'internal' => 'title'],
        'riskmngmt_risk_object_description'    => ['name' => 'riskmngmt_risk_object_description', 'type' => 'string', 'internal' => 'description'],
        'riskmngmt_risk_object_descriptionraw' => ['name' => 'riskmngmt_risk_object_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_risk_object_risk'           => ['name' => 'riskmngmt_risk_object_risk', 'type' => 'int', 'internal' => 'risk'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $belongsTo = [
        'unit' => [
            'mapper' => RiskMapper::class,
            'dest'   => 'riskmngmt_risk_object_risk',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'riskmngmt_risk_object';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'riskmngmt_risk_object_id';
}
