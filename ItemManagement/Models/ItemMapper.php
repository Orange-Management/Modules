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

namespace Modules\ItemManagement\Models;

use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

final class ItemMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'itemmgmt_item_id'           => ['name' => 'itemmgmt_item_id', 'type' => 'int', 'internal' => 'id'],
        'itemmgmt_item_no'           => ['name' => 'itemmgmt_item_no', 'type' => 'string', 'internal' => 'number'],
        'itemmgmt_item_segment'      => ['name' => 'itemmgmt_item_segment', 'type' => 'int', 'internal' => 'segment'],
        'itemmgmt_item_info'         => ['name' => 'itemmgmt_item_info', 'type' => 'string', 'internal' => 'info'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'itemmgmt_item';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'itemmgmt_item_id';    /**
     * Has many relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'media' => [
            'mapper' => MediaMapper::class, /* mapper of the related object */
            'table'  => 'itemmgmt_item_media', /* table of the related object, null if no relation table is used (many->1) */
            'dst'    => 'itemmgmt_item_media_dst',
            'src'    => 'itemmgmt_item_media_src',
        ],
    ];
}
