<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Exchange\Interfaces\GSD\Model
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Interfaces\GSD\Model;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Exchange\Interfaces\GSD\Model
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class GSDCustomerMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'row_id'               => ['name' => 'row_id',          'type' => 'int',      'internal' => 'id'],
        'row_create_time'      => ['name' => 'row_create_time', 'type' => 'DateTime', 'internal' => 'createdAt', 'readonly' => true],
        'row_create_user'      => ['name' => 'row_create_user', 'type' => 'int',      'internal' => 'createdBy', 'readonly' => true],
        'Kundennummer'         => ['name' => 'Kundennummer',    'type' => 'string',   'internal' => 'number'],
    ];

    protected static array $ownsOne = [
        'mainAddress' => [
            'mapper' => GSDAddressMapper::class,
            'self'   => 'AddressId',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'Kunden';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'row_create_time';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'row_id';
}
