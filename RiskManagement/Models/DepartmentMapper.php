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
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

final class DepartmentMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'riskmngmt_department_id'          => ['name' => 'riskmngmt_department_id', 'type' => 'int', 'internal' => 'id'],
        'riskmngmt_department_department'  => ['name' => 'riskmngmt_department_department', 'type' => 'int', 'internal' => 'department'],
        'riskmngmt_department_responsible' => ['name' => 'riskmngmt_department_responsible', 'type' => 'int', 'internal' => 'responsible'],
        'riskmngmt_department_deputy'      => ['name' => 'riskmngmt_department_deputy', 'type' => 'int', 'internal' => 'deputy'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'riskmngmt_department';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'riskmngmt_department_id';

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $belongsTo = [
        'department' => [
            'mapper' => \Modules\Organization\Models\DepartmentMapper::class,
            'dest'   => 'riskmngmt_department_department',
        ],
    ];
}
