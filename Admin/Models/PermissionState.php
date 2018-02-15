<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    Modules\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    /* public */ const SETTINGS = 1;
    /* public */ const ACCOUNT  = 2;
    /* public */ const GROUP    = 3;
    /* public */ const MODULE   = 4;
    /* public */ const LOG      = 5;
}
