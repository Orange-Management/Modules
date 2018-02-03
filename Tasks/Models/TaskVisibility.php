<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    Modules\Tasks
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types = 1);

namespace Modules\Tasks\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Task visibility enum.
 *
 * @package    Modules\Tasks
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class TaskVisibility extends Enum
{
    /* public */ const TO  = 1;
    /* public */ const CC  = 2;
    /* public */ const BCC = 3;
}
