<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Billing\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Billing\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Task type enum.
 *
 * @package Modules\Billing\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class InvoiceStatus extends Enum
{
    public const ACTIVE   = 1;
    public const ARCHIVED = 2;
    public const DELETED  = 4;
    public const DONE     = 8;
    public const DRAFT    = 16;
}
