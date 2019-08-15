<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Knowledgebase\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package    Modules\Knowledgebase\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class PermissionState extends Enum
{
    public const CATEGORY = 1;
    public const WIKI     = 2;
}
