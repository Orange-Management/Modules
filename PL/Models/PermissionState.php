<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\PL
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\PL\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\PL
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const DASHBOARD = 1;
}
