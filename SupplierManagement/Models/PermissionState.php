<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\SupplierManagement
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\SupplierManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\SupplierManagement
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const SUPPLIER = 1;
    public const ANALYSIS = 2;
}
