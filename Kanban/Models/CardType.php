<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Kanban\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Kanban\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Area type enum.
 *
 * @package    Modules\Kanban\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class CardType extends Enum
{
    public const TEXT           = 1; /* Markdown -> Image, links, charts etc */
    public const CALENDAR       = 2;
    public const CALENDAR_EVENT = 4;
    public const TASK           = 8;
    public const TASK_CHECKLIST = 16;
    public const MEDIA          = 32;
    public const SURVEY         = 64;
}
