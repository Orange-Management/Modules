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

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\HumanResourceTimeRecording\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class SessionElementMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'hr_timerecording_session_element_id'      => ['name' => 'hr_timerecording_session_element_id',      'type' => 'int',      'internal' => 'id'],
        'hr_timerecording_session_element_status'  => ['name' => 'hr_timerecording_session_element_status',  'type' => 'int',      'internal' => 'status'],
        'hr_timerecording_session_element_dt'      => ['name' => 'hr_timerecording_session_element_dt',      'type' => 'DateTime', 'internal' => 'dt'],
        'hr_timerecording_session_element_session' => ['name' => 'hr_timerecording_session_element_session', 'type' => 'int',      'internal' => 'session'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'session' => [
            'mapper' => SessionMapper::class,
            'src'    => 'hr_timerecording_session_element_session',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'hr_timerecording_session_element';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'hr_timerecording_session_element_id';
}
