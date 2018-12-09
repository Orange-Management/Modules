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

namespace Modules\Reporter\Models;

use Modules\Admin\Models\AccountMapper;
use Modules\Media\Models\CollectionMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

final class TemplateMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, string|bool>>
     * @since 1.0.0
     */
    protected static $columns = [
        'reporter_template_id'         => ['name' => 'reporter_template_id', 'type' => 'int', 'internal' => 'id'],
        'reporter_template_status'     => ['name' => 'reporter_template_status', 'type' => 'int', 'internal' => 'status'],
        'reporter_template_title'      => ['name' => 'reporter_template_title', 'type' => 'string', 'internal' => 'name'],
        'reporter_template_data'       => ['name' => 'reporter_template_data', 'type' => 'int', 'internal' => 'datatype'],
        'reporter_template_standalone' => ['name' => 'reporter_template_standalone', 'type' => 'bool', 'internal' => 'isStandalone'],
        'reporter_template_expected'   => ['name' => 'reporter_template_expected', 'type' => 'Json', 'internal' => 'expected'],
        'reporter_template_desc'       => ['name' => 'reporter_template_desc', 'type' => 'string', 'internal' => 'description'],
        'reporter_template_desc_raw'   => ['name' => 'reporter_template_desc_raw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'reporter_template_media'      => ['name' => 'reporter_template_media', 'type' => 'int', 'internal' => 'source'],
        'reporter_template_creator'    => ['name'     => 'reporter_template_creator', 'type' => 'int',
                                           'internal' => 'createdBy'],
        'reporter_template_created'    => ['name'     => 'reporter_template_created', 'type' => 'DateTime',
                                           'internal' => 'createdAt'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'source' => [
            'mapper' => CollectionMapper::class,
            'src'    => 'reporter_template_media',
        ],
    ];

    static protected $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'src'    => 'reporter_template_creator',
        ],
    ];


    protected static $hasMany = [
        'reports' => [
            'mapper' => ReportMapper::class,
            'table'  => 'reporter_report',
            'dst'    => 'reporter_report_template',
            'src'    => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'reporter_template';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'reporter_template_created';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'reporter_template_id';
}
