<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Draw
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Draw\Models;

use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package    Modules\Draw
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class DrawImageMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'draw_image_id'    => ['name' => 'draw_image_id', 'type' => 'int', 'internal' => 'id'],
        'draw_image_media' => ['name' => 'draw_image_media', 'type' => 'int', 'internal' => 'media'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'media' => [
            'mapper' => MediaMapper::class,
            'src'    => 'draw_image_media',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'draw_image';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'draw_image_id';
}
