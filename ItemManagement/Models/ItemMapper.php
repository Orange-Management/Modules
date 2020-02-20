<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\ItemManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ItemManagement\Models;

use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Item mapper class.
 *
 * @package Modules\ItemManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ItemMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'itemmgmt_item_id'           => ['name' => 'itemmgmt_item_id',      'type' => 'int',    'internal' => 'id'],
        'itemmgmt_item_no'           => ['name' => 'itemmgmt_item_no',      'type' => 'string', 'internal' => 'number'],
        'itemmgmt_item_segment'      => ['name' => 'itemmgmt_item_segment', 'type' => 'int',    'internal' => 'segment'],
        'itemmgmt_item_info'         => ['name' => 'itemmgmt_item_info',    'type' => 'string', 'internal' => 'info'],
    ];

    protected static array $conditionals = [

    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'itemmgmt_item';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'itemmgmt_item_id';

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'media' => [
            'mapper' => MediaMapper::class, /* mapper of the related object */
            'table'  => 'itemmgmt_item_media', /* table of the related object, null if no relation table is used (many->1) */
            'external' => 'itemmgmt_item_media_dst',
            'self'   => 'itemmgmt_item_media_src',
        ],
    ];
}
