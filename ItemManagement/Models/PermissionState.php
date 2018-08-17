<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\ItemManagement
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\ItemManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\ItemManagement
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const SALES_ITEM    = 1;
    public const PURCHASE_ITEM = 2;
    public const STOCK_ITEM    = 3;
}
