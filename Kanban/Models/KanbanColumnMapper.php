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

namespace Modules\Kanban\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

/**
 * Mapper class.
 *
 * @package    Tasks
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class KanbanColumnMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'kanban_column_id'    => ['name' => 'kanban_column_id', 'type' => 'int', 'internal' => 'id'],
        'kanban_column_name'  => ['name' => 'kanban_column_name', 'type' => 'string', 'internal' => 'name'],
        'kanban_column_order' => ['name' => 'kanban_column_order', 'type' => 'int', 'internal' => 'order'],
        'kanban_column_board' => ['name' => 'kanban_column_board', 'type' => 'int', 'internal' => 'board'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, string|null>>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'cards' => [
            'mapper' => KanbanCardMapper::class,
            'table'  => 'kanban_card',
            'dst'    => 'kanban_card_column',
            'src'    => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'kanban_column';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'kanban_column_id';
}
