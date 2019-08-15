<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Billing
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Billing\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\Billing
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const SALES_INVOICE    = 1;
    public const PURCHASE_INVOICE = 2;
}
