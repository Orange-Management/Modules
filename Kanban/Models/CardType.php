<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);

namespace Modules\Kanban\Models;

use phpOMS\Datatypes\Enum;

/**
 * Area type enum.
 *
 * @category   Framework
 * @package    phpOMS\Utils\Converter
 * @author     OMS Development Team <dev@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class CardType extends Enum
{
    /* public */ const TEXT = 1; /* Markdown -> Image, links, charts etc */
    /* public */ const CALENDAR = 2;
    /* public */ const CALENDAR_EVENT = 4;
    /* public */ const TASK = 8;
    /* public */ const TASK_CHECKLIST = 16;
    /* public */ const MEDIA = 32;
    /* public */ const SURVEY = 64;
}