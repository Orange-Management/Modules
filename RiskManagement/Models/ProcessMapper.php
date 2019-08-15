<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use Modules\Organization\Models\UnitMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

final class ProcessMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'riskmngmt_process_id'             => ['name' => 'riskmngmt_process_id', 'type' => 'int', 'internal' => 'id'],
        'riskmngmt_process_name'           => ['name' => 'riskmngmt_process_name', 'type' => 'string', 'internal' => 'title'],
        'riskmngmt_process_description'    => ['name' => 'riskmngmt_process_description', 'type' => 'string', 'internal' => 'description'],
        'riskmngmt_process_descriptionraw' => ['name' => 'riskmngmt_process_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_process_department'     => ['name' => 'riskmngmt_process_department', 'type' => 'int', 'internal' => 'department'],
        'riskmngmt_process_unit'           => ['name' => 'riskmngmt_process_unit', 'type' => 'int', 'internal' => 'unit'],
        'riskmngmt_process_responsible'    => ['name' => 'riskmngmt_process_responsible', 'type' => 'int', 'internal' => 'responsible'],
        'riskmngmt_process_deputy'         => ['name' => 'riskmngmt_process_deputy', 'type' => 'int', 'internal' => 'deputy'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $belongsTo = [
        'unit'       => [
            'mapper' => UnitMapper::class,
            'dest'   => 'riskmngmt_cause_risk',
        ],
        'department' => [
            'mapper' => DepartmentMapper::class,
            'dest'   => 'riskmngmt_cause_department',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'riskmngmt_process';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'riskmngmt_process_id';
}
