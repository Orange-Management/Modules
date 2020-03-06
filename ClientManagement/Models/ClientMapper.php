<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\ClientManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ClientManagement\Models;

use Modules\Media\Models\MediaMapper;
use Modules\Profile\Models\ContactElementMapper;
use Modules\Profile\Models\ProfileMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Client mapper class.
 *
 * @package Modules\ClientManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ClientMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'clientmgmt_client_id'         => ['name' => 'clientmgmt_client_id',         'type' => 'int',      'internal' => 'id'],
        'clientmgmt_client_no'         => ['name' => 'clientmgmt_client_no',         'type' => 'string',   'internal' => 'number'],
        'clientmgmt_client_no_reverse' => ['name' => 'clientmgmt_client_no_reverse', 'type' => 'string',   'internal' => 'numberReverse'],
        'clientmgmt_client_status'     => ['name' => 'clientmgmt_client_status',     'type' => 'int',      'internal' => 'status'],
        'clientmgmt_client_type'       => ['name' => 'clientmgmt_client_type',       'type' => 'int',      'internal' => 'type'],
        'clientmgmt_client_info'       => ['name' => 'clientmgmt_client_info',       'type' => 'string',   'internal' => 'info'],
        'clientmgmt_client_created_at' => ['name' => 'clientmgmt_client_created_at', 'type' => 'DateTime', 'internal' => 'createdAt', 'readonly' => true],
        'clientmgmt_client_account'    => ['name' => 'clientmgmt_client_account',    'type' => 'int',      'internal' => 'profile'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'clientmgmt_client';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'clientmgmt_client_id';

    /**
     * Created at column
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'clientmgmt_client_created_at';

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:string, self:string, by?:string, column?:string}>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'profile' => [
            'mapper' => ProfileMapper::class,
            'self'   => 'clientmgmt_client_account',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'files'           => [
            'mapper' => MediaMapper::class, /* mapper of the related object */
            'table'  => 'clientmgmt_client_media', /* table of the related object, null if no relation table is used (many->1) */
            'external' => 'clientmgmt_client_media_dst',
            'self'   => 'clientmgmt_client_media_src',
        ],
        'contactElements' => [
            'mapper' => ContactElementMapper::class,
            'table'  => 'clientmgmt_client_contactelement',
            'external' => 'clientmgmt_client_contactelement_dst',
            'self'   => 'clientmgmt_client_contactelement_src',
        ],
    ];
}
