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

use phpOMS\Account\PermissionAbstract;

/**
 * Group permission class.
 *
 * A single permission for a group consisting of read, create, modify, delete and permission flags.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class GroupPermission extends PermissionAbstract
{
    /**
     * Group id
     *
     * @var int
     * @since 1.0.0
     */
    private $group = 0;

    /**
     * Constructor.
     * 
     * @param int $group Group id
     *
     * @since  1.0.0
     */
    public function __construct(int $group = 0)
    {
        $this->group = $group;
    }

    /**
     * Get group id
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getGroup() : int
    {
        return $this->group;
    }
}
