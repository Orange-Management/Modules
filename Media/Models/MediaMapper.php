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

namespace Modules\Media\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

class MediaMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, string|bool>>
     * @since 1.0.0
     */
    protected static $columns = [
        'media_id'              => ['name' => 'media_id', 'type' => 'int', 'internal' => 'id'],
        'media_name'            => ['name' => 'media_name', 'type' => 'string', 'internal' => 'name'],
        'media_description'     => ['name' => 'media_description', 'type' => 'string', 'internal' => 'description'],
        'media_description_raw' => ['name' => 'media_description_raw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'media_versioned'       => ['name' => 'media_versioned', 'type' => 'bool', 'internal' => 'versioned'],
        'media_file'            => ['name' => 'media_file', 'type' => 'string', 'internal' => 'path'],
        'media_absolute'        => ['name' => 'media_absolute', 'type' => 'bool', 'internal' => 'isAbsolute'],
        'media_extension'       => ['name' => 'media_extension', 'type' => 'string', 'internal' => 'extension'],
        'media_size'            => ['name' => 'media_size', 'type' => 'int', 'internal' => 'size'],
        'media_created_by'      => ['name' => 'media_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'media_created_at'      => ['name' => 'media_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    protected static $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'dest'   => 'media_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'media';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'media_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'media_id';
}
