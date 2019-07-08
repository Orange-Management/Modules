<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Accounting\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Account type enum.
 *
 * @package    Modules\Accounting\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class AccountType extends Enum
{
    public const IMPERSONAL = 0;
    public const PERSONAL   = 1;
    public const CREDITOR   = 2;
    public const DEBITOR    = 4;
}
