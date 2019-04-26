<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Tasks
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Tasks\Models;

use Modules\Admin\Models\GroupMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package    Modules\Tasks
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class GroupRelationMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'task_group_id'           => ['name' => 'task_group_id',           'type' => 'int', 'internal' => 'id'],
        'task_group_duty'         => ['name' => 'task_group_duty',         'type' => 'int', 'internal' => 'duty'],
        'task_group_group'        => ['name' => 'task_group_group',        'type' => 'int', 'internal' => 'relation'],
        'task_group_task_element' => ['name' => 'task_group_task_element', 'type' => 'int', 'internal' => 'element'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'relation' => [
            'mapper' => GroupMapper::class,
            'src'    => 'task_group_group',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'task_group';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'task_group_id';
}