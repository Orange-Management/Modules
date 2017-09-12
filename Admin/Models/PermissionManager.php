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

    public function hasPermission(int $permission, int $unit = null, int $app = null, int $module = null, int $type = null, $element = null) : bool
    {
        if(!isset($unit, $app, $module, $type, $element)) {
            return ($permission | $this->permissions['permission']->getPermission()) === $this->permissions['permission']->getPermission();
        } elseif(isset($unit) && !isset($app, $module, $type, $element)) {
            return ($permission | $this->permissions['permission']->getPermission()) === $this->permissions['permission']->getPermission() 
                || ($permission | $this->permissions['unit'][$unit]['permission']->getPermission()) === $this->permissions['unit'][$unit]['permission']->getPermission();
        } elseif(isset($unit, $app) && !isset($module, $type, $element)) {
            return ($permission | $this->permissions['permission']->getPermission()) === $this->permissions['permission']->getPermission() 
                || ($permission | $this->permissions['unit'][$unit]['permission']->getPermission()) === $this->permissions['unit'][$unit]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['permission']->getPermission();
        } elseif(isset($unit, $app, $module) && !isset($type, $element)) {
            return ($permission | $this->permissions['permission']->getPermission()) === $this->permissions['permission']->getPermission() 
                || ($permission | $this->permissions['unit'][$unit]['permission']->getPermission()) === $this->permissions['unit'][$unit]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['permission']->getPermission();
        } elseif(isset($unit, $app, $module, $type) && !isset($element)) {
            return ($permission | $this->permissions['permission']->getPermission()) === $this->permissions['permission']->getPermission() 
                || ($permission | $this->permissions['unit'][$unit]['permission']->getPermission()) === $this->permissions['unit'][$unit]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['type'][$type]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['type'][$type]['permission']->getPermission();
        } elseif(isset($unit, $app, $module, $type) && !isset($element)) {
            return ($permission | $this->permissions['permission']->getPermission()) === $this->permissions['permission']->getPermission() 
                || ($permission | $this->permissions['unit'][$unit]['permission']->getPermission()) === $this->permissions['unit'][$unit]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['type'][$type]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['type'][$type]['permission']->getPermission()
                || ($permission | $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['type'][$type]['element'][$element]['permission']->getPermission()) === $this->permissions['unit'][$unit]['app'][$app]['module'][$mdoule]['type'][$type]['element'][$element]['permission']->getPermission();
        } 
    }

    public function hasPermission2(int $permission, int $unit = null, int $app = null, int $module = null, int $type = null, $element = null) : bool
    {
        foreach($this->permissions as $permission) {
            if(($permissions | $permission->getPermission()) === $permission->getPermission()) {
                return true;
            }
        }

        return false;
    }
}
