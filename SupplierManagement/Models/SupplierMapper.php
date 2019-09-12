<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   TBD
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\SupplierManagement\Models;

use Modules\Media\Models\MediaMapper;
use Modules\Profile\Models\ContactElementMapper;
use Modules\Profile\Models\ProfileMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Column;

final class SupplierMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var   array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'suppliermgmt_supplier_id'         => ['name' => 'suppliermgmt_supplier_id', 'type' => 'int', 'internal' => 'id'],
        'suppliermgmt_supplier_no'         => ['name' => 'suppliermgmt_supplier_no', 'type' => 'string', 'internal' => 'number'],
        'suppliermgmt_supplier_no_reverse' => ['name' => 'suppliermgmt_supplier_no_reverse', 'type' => 'string', 'internal' => 'numberReverse'],
        'suppliermgmt_supplier_status'     => ['name' => 'suppliermgmt_supplier_status', 'type' => 'int', 'internal' => 'status'],
        'suppliermgmt_supplier_type'       => ['name' => 'suppliermgmt_supplier_type', 'type' => 'int', 'internal' => 'type'],
        'suppliermgmt_supplier_taxid'      => ['name' => 'suppliermgmt_supplier_taxid', 'type' => 'int', 'internal' => 'taxId'],
        'suppliermgmt_supplier_info'       => ['name' => 'suppliermgmt_supplier_info', 'type' => 'string', 'internal' => 'info'],
        'suppliermgmt_supplier_created_at' => ['name' => 'suppliermgmt_supplier_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
        'suppliermgmt_supplier_account'    => ['name' => 'suppliermgmt_supplier_account', 'type' => 'int', 'internal' => 'profile'],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'suppliermgmt_supplier';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'suppliermgmt_supplier_id';

    /**
     * Created at column
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $createdAt = 'suppliermgmt_supplier_created_at';

    /**
     * Has one relation.
     *
     * @var   array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'profile' => [
            'mapper' => ProfileMapper::class,
            'src'    => 'suppliermgmt_supplier_account',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var   array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'files'           => [
            'mapper' => MediaMapper::class, /* mapper of the related object */
            'table'  => 'suppliermgmt_supplier_media', /* table of the related object, null if no relation table is used (many->1) */
            'dst'    => 'suppliermgmt_supplier_media_dst',
            'src'    => 'suppliermgmt_supplier_media_src',
        ],
        'contactElements' => [
            'mapper' => ContactElementMapper::class,
            'table'  => 'suppliermgmt_supplier_contactelement',
            'dst'    => 'suppliermgmt_supplier_contactelement_dst',
            'src'    => 'suppliermgmt_supplier_contactelement_src',
        ],
    ];
}
