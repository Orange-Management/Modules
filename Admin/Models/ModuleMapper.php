<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Module mapper class.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class ModuleMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'module_id'     => ['name' => 'module_id', 'type' => 'string', 'internal' => 'id'],
        'module_active' => ['name' => 'module_active', 'type' => 'int', 'internal' => 'status'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'module';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'module_id';
}
