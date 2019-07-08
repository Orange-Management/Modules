<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
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
 * Task status enum.
 *
 * @package    Modules\Knowledgebase\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class WikiStatus extends Enum
{
    public const ACTIVE = 1;

    public const INACTIVE = 2;

    public const DRAFT = 3;
}
