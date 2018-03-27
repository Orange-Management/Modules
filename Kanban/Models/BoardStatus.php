<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Kanban\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Task status enum.
 *
 * @package    Kanban
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class BoardStatus extends Enum
{
    public const ACTIVE = 1;

    public const INACTIVE = 2;

    public const ARCHIVED = 3;
}
