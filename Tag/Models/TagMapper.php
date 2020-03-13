<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tag\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tag\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Tag mapper class.
 *
 * @package Modules\Tag\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class TagMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'tag_id'    => ['name' => 'tag_id',    'type' => 'int',    'internal' => 'id'],
        'tag_color' => ['name' => 'tag_color', 'type' => 'string', 'internal' => 'color'],
        'tag_type'  => ['name' => 'tag_type',  'type' => 'int',    'internal' => 'type'],
        'tag_owner' => ['name' => 'tag_owner', 'type' => 'int',    'internal' => 'owner'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'title' => [
            'mapper'   => L11nTagMapper::class,
            'table'    => 'tag_l11n',
            'external' => 'tag_l11n_tag',
            'column'   => 'title',
            'self'     => null,
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    /*
    protected static array $belongsTo = [
        'owner' => [
            'mapper' => AccountMapper::class,
            'self'   => 'tag_owner',
        ],
    ];
    */

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'tag';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'tag_id';
}
