<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Auditor\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Auditor\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Auditor\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class AuditMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'auditor_audit_id'         => ['name' => 'auditor_audit_id',         'type' => 'int',      'internal' => 'id'],
        'auditor_audit_created_by' => ['name' => 'auditor_audit_created_by', 'type' => 'int',      'internal' => 'createdBy', 'readonly' => true],
        'auditor_audit_created_at' => ['name' => 'auditor_audit_created_at', 'type' => 'DateTime', 'internal' => 'createdAt', 'readonly' => true],
        'auditor_audit_ip'         => ['name' => 'auditor_audit_ip',         'type' => 'int',      'internal' => 'ip'],
        'auditor_audit_module'     => ['name' => 'auditor_audit_module',     'type' => 'string',   'internal' => 'module'],
        'auditor_audit_ref'        => ['name' => 'auditor_audit_ref',        'type' => 'string',   'internal' => 'ref'],
        'auditor_audit_type'       => ['name' => 'auditor_audit_type',       'type' => 'int',      'internal' => 'type'],
        'auditor_audit_subtype'    => ['name' => 'auditor_audit_subtype',    'type' => 'int',      'internal' => 'subtype'],
        'auditor_audit_content'    => ['name' => 'auditor_audit_content',    'type' => 'string',   'internal' => 'content'],
        'auditor_audit_old'        => ['name' => 'auditor_audit_old',        'type' => 'string',   'internal' => 'old'],
        'auditor_audit_new'        => ['name' => 'auditor_audit_new',        'type' => 'string',   'internal' => 'new'],
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
            'self'   => 'auditor_audit_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'auditor_audit';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'auditor_audit_id';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'auditor_audit_created_at';
}
