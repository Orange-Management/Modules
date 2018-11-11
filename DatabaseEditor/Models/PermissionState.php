<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\DatabaseEditor
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\DatabaseEditor\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\DatabaseEditor
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const DATABASE_EDITOR = 1;
    public const TEMPLATE = 2;
}
