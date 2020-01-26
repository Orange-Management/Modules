<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Support\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Support\Models;

use Modules\Tasks\Models\TaskMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Support\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class TicketMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'support_ticket_id'   => ['name' => 'support_ticket_id',   'type' => 'int', 'internal' => 'id'],
        'support_ticket_task' => ['name' => 'support_ticket_task', 'type' => 'int', 'internal' => 'task'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'task' => [
            'mapper' => TaskMapper::class,
            'src'    => 'support_ticket_task',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'support_ticket';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'support_ticket_id';
}
