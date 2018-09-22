<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Profile\Models
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
use Modules\Admin\Models\Account;
use Modules\Admin\Models\AccountMapper;
use Modules\Calendar\Models\CalendarMapper;

/**
 * Profile mapper.
 *
 * @package    Modules\Profile
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class ProfileMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, string|bool>>
     * @since 1.0.0
     */
    protected static $columns = [
        'profile_account_id'       => ['name' => 'profile_account_id', 'type' => 'int', 'internal' => 'id'],
        'profile_account_image'    => ['name' => 'profile_account_image', 'type' => 'int', 'internal' => 'image'],
        'profile_account_birthday' => ['name' => 'profile_account_birthday', 'type' => 'DateTime', 'internal' => 'birthday'],
        'profile_account_account'  => ['name' => 'profile_account_account', 'type' => 'int', 'internal' => 'account'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $ownsOne = [
        'account'  => [
            'mapper' => AccountMapper::class,
            'src'    => 'profile_account_account',
        ],
        'image'    => [
            'mapper' => MediaMapper::class,
            'src'    => 'profile_account_image',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array<string, string|null>>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'location' => [
            'mapper' => AddressMapper::class,
            'table'  => 'profile_address',
            'dst'    => 'profile_address_account',
            'src'    => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'profile_account';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'profile_account_id';
}
