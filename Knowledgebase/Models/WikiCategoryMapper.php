<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Knowledgebase\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Knowledgebase\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class WikiCategoryMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'wiki_category_id'     => ['name' => 'wiki_category_id',     'type' => 'int',    'internal' => 'id'],
        'wiki_category_app'    => ['name' => 'wiki_category_app',    'type' => 'int',    'internal' => 'app'],
        'wiki_category_name'   => ['name' => 'wiki_category_name',   'type' => 'string', 'internal' => 'name'],
        'wiki_category_path'   => ['name' => 'wiki_category_path',   'type' => 'string', 'internal' => 'path'],
        'wiki_category_parent' => ['name' => 'wiki_category_parent', 'type' => 'int',    'internal' => 'parent'],
    ];

    /**
     * Has owns one relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'parent' => [
            'mapper' => WikiCategoryMapper::class,
            'self'   => 'wiki_category_parent',
        ],
        'app' => [
            'mapper' => WikiAppMapper::class,
            'self' => 'wiki_category_app'
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'wiki_category';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'wiki_category_id';
}
