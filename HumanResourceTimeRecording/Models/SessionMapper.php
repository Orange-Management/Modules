<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\HumanResourceTimeRecording\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\HumanResourceTimeRecording\Models;

use Modules\HumanResourceManagement\Models\EmployeeMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\HumanResourceTimeRecording\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class SessionMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var   array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'hr_timerecording_session_id'       => ['name' => 'hr_timerecording_session_id',       'type' => 'int',      'internal' => 'id'],
        'hr_timerecording_session_type'     => ['name' => 'hr_timerecording_session_type',     'type' => 'int',      'internal' => 'type'],
        'hr_timerecording_session_start'    => ['name' => 'hr_timerecording_session_start',    'type' => 'DateTime', 'internal' => 'start'],
        'hr_timerecording_session_end'      => ['name' => 'hr_timerecording_session_end',      'type' => 'DateTime', 'internal' => 'end'],
        'hr_timerecording_session_busy'     => ['name' => 'hr_timerecording_session_busy',     'type' => 'int',      'internal' => 'busy'],
        'hr_timerecording_session_employee' => ['name' => 'hr_timerecording_session_employee', 'type' => 'int',      'internal' => 'employee'],
    ];

    /**
     * Has many relation.
     *
     * @var   array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'sessionElements' => [
            'mapper' => SessionElementMapper::class,
            'table'  => 'hr_timerecording_session_element',
            'dst'    => 'hr_timerecording_session_element_session',
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
        'employee' => [
            'mapper' => EmployeeMapper::class,
            'src'    => 'hr_timerecording_session_employee',
        ],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'hr_timerecording_session';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'hr_timerecording_session_id';
}
