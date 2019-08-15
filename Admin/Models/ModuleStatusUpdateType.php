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

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       https://orange-management.org
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
