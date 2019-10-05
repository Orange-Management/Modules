<?php

/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Address\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Address\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Country mapper class.
 *
 * @package Modules\Address\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class CountryMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var   array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'country_id'      => ['name' => 'country_id',      'type' => 'int',    'internal' => 'id'],
        'country_name'    => ['name' => 'country_name',    'type' => 'string', 'internal' => 'name'],
        'country_native'  => ['name' => 'country_native',  'type' => 'string', 'internal' => 'native'],
        'country_code2'   => ['name' => 'country_code2',   'type' => 'string', 'internal' => 'code2'],
        'country_code3'   => ['name' => 'country_code3',   'type' => 'string', 'internal' => 'code3'],
        'country_codenum' => ['name' => 'country_codenum', 'type' => 'int',    'internal' => 'codenum'],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'country';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'country_id';
}
