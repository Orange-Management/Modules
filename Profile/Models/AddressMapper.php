<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Profile\Models;

use Modules\Media\Models\MediaMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;
use phpOMS\Stdlib\Base\Location;

class AddressMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'profile_address_id'         => ['name' => 'profile_address_id', 'type' => 'int', 'internal' => 'id'],
        'profile_address_type'         => ['name' => 'profile_address_type', 'type' => 'int', 'internal' => 'type'],
        'profile_address_address'         => ['name' => 'profile_address_address', 'type' => 'string', 'internal' => 'address'],
        'profile_address_street'         => ['name' => 'profile_address_street', 'type' => 'string', 'internal' => 'street'],
        'profile_address_city'         => ['name' => 'profile_address_city', 'type' => 'string', 'internal' => 'city'],
        'profile_address_zip'         => ['name' => 'profile_address_zip', 'type' => 'string', 'internal' => 'postal'],
        'profile_address_country'         => ['name' => 'profile_address_country', 'type' => 'string', 'internal' => 'country'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'profile_address';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'profile_address_id';
}
