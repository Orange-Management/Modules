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

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class ModuleStatusUpdateType extends Enum
{
    public const ACTIVATE   = 1;
    public const DEACTIVATE = 2;
    public const INSTALL    = 3;
    public const UNINSTALL  = 4;
    public const DELETE     = 5;
    public const UPDATE     = 6;
}
