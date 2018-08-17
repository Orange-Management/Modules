<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Help
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Help\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\Help
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const HELP_GENERAL   = 1;
    public const HELP_MODULE    = 2;
    public const HELP_DEVELOPER = 3;
}
