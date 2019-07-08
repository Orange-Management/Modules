<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Shop
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Shop\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\Shop
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const ARTICLE = 1;
    public const BUYER   = 2;
    public const SELLER  = 3;
    public const SHOP    = 4;
}
