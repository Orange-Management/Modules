<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Chat
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Chat;

use phpOMS\Stdlib\Base\Enum;

/**
 * Room type enum.
 *
 * @package    Modules\Chat
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class RoomType extends Enum
{
    public const PUBLIC_CHAT = 0;

    public const PRIVATE_CHAT = 1;

    public const TEMP_CHAT = 2;
}
