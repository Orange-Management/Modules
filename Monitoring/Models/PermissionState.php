<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Monitoring
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Monitoring\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\Monitoring
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const DASHBOARD = 1;
    public const LOG       = 2;
    public const SECURITY  = 3;
}
