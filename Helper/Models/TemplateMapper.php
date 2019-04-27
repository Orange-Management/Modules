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

namespace Modules\Helper\Models;

use Modules\Admin\Models\AccountMapper;
use Modules\Media\Models\CollectionMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

final class TemplateMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'helper_template_id'         => ['name' => 'helper_template_id', 'type' => 'int', 'internal' => 'id'],
        'helper_template_status'     => ['name' => 'helper_template_status', 'type' => 'int', 'internal' => 'status'],
        'helper_template_title'      => ['name' => 'helper_template_title', 'type' => 'string', 'internal' => 'name'],
        'helper_template_data'       => ['name' => 'helper_template_data', 'type' => 'int', 'internal' => 'datatype'],
        'helper_template_standalone' => ['name' => 'helper_template_standalone', 'type' => 'bool', 'internal' => 'isStandalone'],
        'helper_template_expected'   => ['name' => 'helper_template_expected', 'type' => 'Json', 'internal' => 'expected'],
        'helper_template_desc'       => ['name' => 'helper_template_desc', 'type' => 'string', 'internal' => 'description'],
        'helper_template_desc_raw'   => ['name' => 'helper_template_desc_raw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'helper_template_media'      => ['name' => 'helper_template_media', 'type' => 'int', 'internal' => 'source'],
        'helper_template_creator'    => ['name'     => 'helper_template_creator', 'type' => 'int',
                                           'internal' => 'createdBy', ],
        'helper_template_created'    => ['name'     => 'helper_template_created', 'type' => 'DateTime',
                                           'internal' => 'createdAt', ],
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
            'src'    => 'helper_template_media',
        ],
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
            'src'    => 'helper_template_creator',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'reports' => [
            'mapper' => ReportMapper::class,
            'table'  => 'helper_report',
            'dst'    => 'helper_report_template',
            'src'    => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'helper_template';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'helper_template_created';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'helper_template_id';
}
