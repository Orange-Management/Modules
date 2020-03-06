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

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\Localization\Defaults\LanguageMapper;

/**
 * Tag mapper class.
 *
 * @package Modules\Tag\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class L11nTagMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'tag_l11n_id'       => ['name' => 'tag_l11n_id',       'type' => 'int',    'internal' => 'id'],
        'tag_l11n_title'    => ['name' => 'tag_l11n_title',    'type' => 'string', 'internal' => 'title', 'autocomplete' => true],
        'tag_l11n_tag'      => ['name' => 'tag_l11n_tag',      'type' => 'int',    'internal' => 'tag'],
        'tag_l11n_language' => ['name' => 'tag_l11n_language', 'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:string, self:string, by?:string, column?:string}>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'language' => [
            'mapper' => LanguageMapper::class,
            'self'   => 'tag_l11n_language',
            'by'     => 'code2',
            'column' => 'code2',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'tag_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'tag_l11n_id';
}
