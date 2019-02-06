<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Navigation\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Navigation\Models;

/**
 * Navigation element class.
 *
 * @package    Modules\Navigation\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class NavElement
{
    public $id                = 0;
    public $pid               = '';
    public $name              = '';
    public $type              = 1;
    public $subtype           = 2;
    public $icon              = null;
    public $uri               = null;
    public $target            = 'self';
    public $from              = '0';
    public $order             = 1;
    public $parent            = 0;
    public $permissionPerm    = null;
    public $permissionType    = null;
    public $permissionElement = null;
}
