<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Navigation\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Navigation\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Link type enum.
 *
 * @package    Modules\Navigation\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class LinkType extends Enum
{
    public const CATEGORY = 0;
    public const LINK     = 1;
}
