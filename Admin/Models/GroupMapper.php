<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Group mapper class.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class GroupMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'group_id'       => ['name' => 'group_id', 'type' => 'int', 'internal' => 'id'],
        'group_name'     => ['name' => 'group_name', 'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'group_status'   => ['name' => 'group_status', 'type' => 'int', 'internal' => 'status'],
        'group_desc'     => ['name' => 'group_desc', 'type' => 'string', 'internal' => 'description'],
        'group_desc_raw' => ['name' => 'group_desc_raw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'group_created'  => ['name' => 'group_created', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'group';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'group_id';

    /**
     * Created at column
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'group_created';

    /**
     * Has many relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $hasMany = [
        'accounts' => [
            'mapper' => AccountMapper::class,
            'table'  => 'account_group',
            'dst'    => 'account_group_group',
            'src'    => 'account_group_account',
        ],
    ];
}
