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
final class GSDAddressMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'AdressRowId'     => ['name' => 'AdressRowId',     'type' => 'int',      'internal' => 'id'],
        'row_create_time' => ['name' => 'row_create_time', 'type' => 'DateTime', 'internal' => 'createdAt'],
        'row_create_user' => ['name' => 'row_create_user', 'type' => 'int',      'internal' => 'createdBy'],
        'NAME1'           => ['name' => 'NAME1',           'type' => 'string',   'internal' => 'name1'],
        'NAME2'           => ['name' => 'NAME2',           'type' => 'string',   'internal' => 'name2'],
        'NAME3'           => ['name' => 'NAME3',           'type' => 'string',   'internal' => 'name3'],
        'ORT'             => ['name' => 'ORT',             'type' => 'string',   'internal' => 'city'],
        'PLZ'             => ['name' => 'PLZ',             'type' => 'string',   'internal' => 'zip'],
        'STRASSE'         => ['name' => 'STRASSE',         'type' => 'string',   'internal' => 'street'],
        'LAND'            => ['name' => 'LAND',            'type' => 'string',   'internal' => 'country'],
        'TELEFON'         => ['name' => 'TELEFON',         'type' => 'string',   'internal' => 'phone'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'KUNDENADRESSE';

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
    protected static string $primaryField = 'AdressRowId';
}
