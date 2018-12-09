<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Kanban\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Kanban\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package    Modules\Kanban\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class KanbanLabelMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, string|bool>>
     * @since 1.0.0
     */
    protected static $columns = [
        'kanban_label_id'    => ['name' => 'kanban_label_id', 'type' => 'int', 'internal' => 'id'],
        'kanban_label_name'  => ['name' => 'kanban_label_name', 'type' => 'string', 'internal' => 'name'],
        'kanban_label_color' => ['name' => 'kanban_label_color', 'type' => 'int', 'internal' => 'color'],
        'kanban_label_board' => ['name' => 'kanban_label_board', 'type' => 'int', 'internal' => 'board'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'kanban_label';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'kanban_label_id';
}
