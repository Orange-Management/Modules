<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Organization
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Organization\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Accept status enum.
 *
 * @package    Modules\Organization
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class Status extends Enum
{
    public const ACTIVE   = 1;
    public const INACTIVE = 2;
    public const HIDDEN   = 4;
}
