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
 * Contact mapper class.
 *
 * @package Modules\Profile\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ContactElementMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'profile_contact_id' => ['name' => 'profile_contact_id', 'type' => 'int', 'internal' => 'id'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'profile_contact';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'profile_contact_id';
}
