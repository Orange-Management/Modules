<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Media\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Media\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Media mapper class.
 *
 * @package    Modules\Media\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class MediaMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     * @todo: maybe add file name for searching by file name (path in media_file should not matter for search)
     */
    protected static $columns = [
        'media_id'              => ['name' => 'media_id', 'type' => 'int', 'internal' => 'id'],
        'media_name'            => ['name' => 'media_name', 'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'media_description'     => ['name' => 'media_description', 'type' => 'string', 'internal' => 'description', 'autocomplete' => true],
        'media_description_raw' => ['name' => 'media_description_raw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'media_versioned'       => ['name' => 'media_versioned', 'type' => 'bool', 'internal' => 'versioned'],
        'media_file'            => ['name' => 'media_file', 'type' => 'string', 'internal' => 'path', 'autocomplete' => true],
        'media_virtual'         => ['name' => 'media_virtual', 'type' => 'string', 'internal' => 'virtualPath', 'autocomplete' => true],
        'media_absolute'        => ['name' => 'media_absolute', 'type' => 'bool', 'internal' => 'isAbsolute'],
        'media_extension'       => ['name' => 'media_extension', 'type' => 'string', 'internal' => 'extension'],
        'media_size'            => ['name' => 'media_size', 'type' => 'int', 'internal' => 'size'],
        'media_created_by'      => ['name' => 'media_created_by', 'type' => 'int', 'internal' => 'createdBy'],
        'media_created_at'      => ['name' => 'media_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
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

    /**
     * Get media based on virtual path.
     *
     * The virtual path is equivalent to the directory path on a file system.
     *
     * A media model also has a file path, this however doesn't have to be the same as the virtual path
     * and in fact most of the time it is different. This is because the location on a hard drive or web
     * drive should not have any impact on the media file/media structure in the application.
     *
     * As a result media files are structured by virutal path in the app, by file path on the file system
     * and by Collections which can have sub-collections as well. Collections allow to reference files
     * in a different virtual path and are therfore similar to "symlinks", except that they don't reference
     * a file but create a new virtual media model which groups other media models together in a new virtual
     * path if so desired without deleting or moving the orginal media files.
     *
     * @param string $virtualPath Virtual path
     *
     * @return array
     *
     * @since  1.0.0
     */
    public static function getByVirtualPath(string $virtualPath = '/') : array
    {
        $query = self::getQuery();
        $query->where(self::$table . '.media_virtual', '=', $virtualPath);

        return self::getAllByQuery($query);
    }
}
