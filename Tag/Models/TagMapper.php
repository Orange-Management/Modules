<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Tag
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tag\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Tag mapper class.
 *
 * @package    Modules\Tag
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class TagMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'tag_id'         => ['name' => 'tag_id',         'type' => 'int',    'internal' => 'id'],
        'tag_title'      => ['name' => 'tag_title',      'type' => 'string', 'internal' => 'title'],
        'tag_color'      => ['name' => 'tag_color',      'type' => 'string', 'internal' => 'color'],
        'tag_type'       => ['name' => 'tag_type',       'type' => 'int',    'internal' => 'type'],
        'tag_color'      => ['name' => 'tag_color',      'type' => 'string', 'internal' => 'color'],
        'tag_created_by' => ['name' => 'tag_created_by', 'type' => 'int',    'internal' => 'createdBy'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'src'    => 'tag_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'tag';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'tag_id';
}
