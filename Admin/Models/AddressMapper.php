<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\Localization\Defaults\CountryMapper;

/**
 * Address mapper class.
 *
 * @package Modules\Admin\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class AddressMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'address_id'      => ['name' => 'address_id',      'type' => 'int',    'internal' => 'id'],
        'address_street'  => ['name' => 'address_street',  'type' => 'string', 'internal' => 'address'],
        'address_postal'  => ['name' => 'address_postal',  'type' => 'string', 'internal' => 'postal'],
        'address_state'   => ['name' => 'address_state',   'type' => 'string', 'internal' => 'state'],
        'address_city'    => ['name' => 'address_city',    'type' => 'string', 'internal' => 'city'],
        'address_country' => ['name' => 'address_country', 'type' => 'int',    'internal' => 'country'],
    ];

    /**
     * Has one relation.
     *
     * @todo Orange-Management/phpOMS#224
     *  Implement composite models.
     *  If a column is defined only that column value should get populated in the model and not the full model!
     *  OwnsOne, HasOne, use single value instead of full model defined in the mapper.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'country' => [
            'mapper' => CountryMapper::class,
            'column' => '',
            'src'    => 'address_country',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'address';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'address_id';
}
