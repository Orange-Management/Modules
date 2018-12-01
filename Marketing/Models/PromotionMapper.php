<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Marketing\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Marketing\Models;

use Modules\Calendar\Models\CalendarMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;
use Modules\Tasks\Models\TaskMapper;
use Modules\Media\Models\MediaMapper;

/**
 * Mapper class.
 *
 * @package    Modules\Marketing\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class PromotionMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, string|bool>>
     * @since 1.0.0
     */
    protected static $columns = [
        'marketing_promotion_id'          => ['name' => 'marketing_promotion_id', 'type' => 'int', 'internal' => 'id'],
        'marketing_promotion_name'        => ['name' => 'marketing_promotion_name', 'type' => 'string', 'internal' => 'name'],
        'marketing_promotion_description' => ['name' => 'marketing_promotion_description', 'type' => 'string', 'internal' => 'description'],
        'marketing_promotion_calendar'    => ['name' => 'marketing_promotion_calendar', 'type' => 'int', 'internal' => 'calendar'],
        'marketing_promotion_costs'       => ['name' => 'marketing_promotion_costs', 'type' => 'Serializable', 'internal' => 'costs'],
        'marketing_promotion_budget'      => ['name' => 'marketing_promotion_budget', 'type' => 'Serializable', 'internal' => 'budget'],
        'marketing_promotion_earnings'    => ['name' => 'marketing_promotion_earnings', 'type' => 'Serializable', 'internal' => 'earnings'],
        'marketing_promotion_start'       => ['name' => 'marketing_promotion_start', 'type' => 'DateTime', 'internal' => 'start'],
        'marketing_promotion_end'         => ['name' => 'marketing_promotion_end', 'type' => 'DateTime', 'internal' => 'end'],
        'marketing_promotion_created_by'  => ['name' => 'marketing_promotion_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'marketing_promotion_created_at'  => ['name' => 'marketing_promotion_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, string|null>>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'tasks' => [
            'mapper' => TaskMapper::class,
            'table'  => 'marketing_promotion_task_relation',
            'dst'    => 'marketing_promotion_task_relation_dst',
            'src'    => 'marketing_promotion_task_relation_src',
        ],
        'media' => [ // todo: maybe make this a has one and then link to collection instead of single media files!
                     'mapper' => MediaMapper::class,
                     'table'  => 'marketing_promotion_media',
                     'dst'    => 'marketing_promotion_media_src',
                     'src'    => 'marketing_promotion_media_dst',
        ],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'calendar' => [
            'mapper' => CalendarMapper::class,
            'src'    => 'marketing_promotion_calendar',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'marketing_promotion';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'marketing_promotion_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'marketing_promotion_id';
}
