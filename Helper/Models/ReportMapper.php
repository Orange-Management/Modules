<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Helper\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Helper\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Report mapper class.
 *
 * @package Modules\Helper\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ReportMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'helper_report_id'       => ['name' => 'helper_report_id',       'type' => 'int',      'internal' => 'id'],
        'helper_report_status'   => ['name' => 'helper_report_status',   'type' => 'int',      'internal' => 'status'],
        'helper_report_title'    => ['name' => 'helper_report_title',    'type' => 'string',   'internal' => 'title'],
        'helper_report_desc'     => ['name' => 'helper_report_desc',     'type' => 'string',   'internal' => 'description'],
        'helper_report_desc_raw' => ['name' => 'helper_report_desc_raw', 'type' => 'string',   'internal' => 'descriptionRaw'],
        'helper_report_media'    => ['name' => 'helper_report_media',    'type' => 'int',      'internal' => 'source'],
        'helper_report_template' => ['name' => 'helper_report_template', 'type' => 'int',      'internal' => 'template'],
        'helper_report_creator'  => ['name' => 'helper_report_creator',  'type' => 'int',      'internal' => 'createdBy', 'readonly' => true],
        'helper_report_created'  => ['name' => 'helper_report_created',  'type' => 'DateTime', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:string, self:string, by?:string, column?:string}>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'source'   => [
            'mapper' => \Modules\Media\Models\CollectionMapper::class,
            'self'   => 'helper_report_media',
        ],
        'template' => [
            'mapper' => TemplateMapper::class,
            'self'   => 'helper_report_template',
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'self'   => 'helper_report_creator',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'helper_report';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'helper_report_id';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'helper_report_created';
}
