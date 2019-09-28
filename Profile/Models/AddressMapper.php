<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Profile\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Profile\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Address mapper.
 *
 * @package Modules\Profile\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class AddressMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var   array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'profile_address_id'      => ['name' => 'profile_address_id', 'type' => 'int', 'internal' => 'id'],
        'profile_address_type'    => ['name' => 'profile_address_type', 'type' => 'int', 'internal' => 'type'],
        'profile_address_address' => ['name' => 'profile_address_address', 'type' => 'string', 'internal' => 'address'],
        'profile_address_street'  => ['name' => 'profile_address_street', 'type' => 'string', 'internal' => 'street'],
        'profile_address_city'    => ['name' => 'profile_address_city', 'type' => 'string', 'internal' => 'city'],
        'profile_address_zip'     => ['name' => 'profile_address_zip', 'type' => 'string', 'internal' => 'postal'],
        'profile_address_country' => ['name' => 'profile_address_country', 'type' => 'string', 'internal' => 'country'],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'profile_address';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'profile_address_id';
}
