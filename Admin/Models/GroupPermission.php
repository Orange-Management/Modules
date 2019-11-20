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

use phpOMS\Account\PermissionAbstract;
use phpOMS\Account\PermissionType;

/**
 * Group permission class.
 *
 * A single permission for a group consisting of read, create, modify, delete and permission flags.
 *
 * @package Modules\Admin\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class GroupPermission extends PermissionAbstract
{
    /**
     * Group id
     *
     * @var   int
     * @since 1.0.0
     */
    private int $group = 0;

    /**
     * Constructor.
     *
     * @param int         $group      Group id
     * @param null|int    $unit       Unit Unit to check (null if all are acceptable)
     * @param null|string $app        App App to check  (null if all are acceptable)
     * @param null|string $module     Module to check  (null if all are acceptable)
     * @param int         $from       Module providing this permission
     * @param null|int    $type       Type (e.g. customer) (null if all are acceptable)
     * @param null|int    $element    (e.g. customer id) (null if all are acceptable)
     * @param null|int    $component  (e.g. address) (null if all are acceptable)
     * @param int         $permission Permission to check
     *
     * @since 1.0.0
     */
    public function __construct(
        int $group = 0,
        int $unit = null,
        string $app = null,
        string $module = null,
        int $from = 0,
        int $type = null,
        int $element = null,
        int $component = null,
        int $permission = PermissionType::NONE
    ) {
        $this->group = $group;
        parent::__construct($unit, $app, $module, $from, $type, $element, $component, $permission);
    }

    /**
     * Get group id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getGroup() : int
    {
        return $this->group;
    }
}
