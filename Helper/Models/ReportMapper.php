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
use phpOMS\DataStorage\Database\DataMapperAbstract;

final class ReportMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'helper_report_id'       => ['name' => 'helper_report_id', 'type' => 'int', 'internal' => 'id'],
        'helper_report_status'   => ['name' => 'helper_report_status', 'type' => 'int', 'internal' => 'status'],
        'helper_report_title'    => ['name' => 'helper_report_title', 'type' => 'string', 'internal' => 'title'],
        'helper_report_desc'     => ['name' => 'helper_report_desc', 'type' => 'string', 'internal' => 'description'],
        'helper_report_desc_raw' => ['name' => 'helper_report_desc_raw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'helper_report_media'    => ['name' => 'helper_report_media', 'type' => 'int', 'internal' => 'source'],
        'helper_report_template' => ['name' => 'helper_report_template', 'type' => 'int', 'internal' => 'template'],
        'helper_report_creator'  => ['name' => 'helper_report_creator', 'type' => 'int', 'internal' => 'createdBy'],
        'helper_report_created'  => ['name' => 'helper_report_created', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'source'   => [
            'mapper' => \Modules\Media\Models\CollectionMapper::class,
            'src'    => 'helper_report_media',
        ],
        'template' => [
            'mapper' => \Modules\Helper\Models\TemplateMapper::class,
            'src'    => 'helper_report_template',
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
            'src'    => 'helper_report_creator',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'helper_report';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'helper_report_id';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'helper_report_created';
}
