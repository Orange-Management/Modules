<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Admin\Models;

/**
 * InfoManager class.
 *
 * Handling the info files for modules
 *
 * @category   Framework
 * @package    phpOMS\Module
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class PermissionManager
{
    private $permissions = [];

    private $id = 0;

    public function __construct(int $id, array $permissions)
    {
        $this->id = $id;
        $this->permissions = $permissions;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function hasPermission(int $permission, int $unit = null, int $app = null, int $module = null, int $type = null, $element = null, $component = null) : bool
    {
        foreach($this->permissions as $p) {
            if(($p->getUnit() === $unit || $p->getUnit() === null)
                && ($p->getApp() === $app || $p->getApp() === null) 
                && ($p->getModule() === $module || $p->getModule() === null) 
                && ($p->getType() === $type || $p->getType() === null) 
                && ($p->getElement() === $element || $p->getElement() === null) 
                && ($p->getComponent() === $component || $p->getComponent() === null) 
                && ($permissions | $p->getPermission()) === $p->getPermission()) {
                return true;
            }
        }

        return false;
    }
}
