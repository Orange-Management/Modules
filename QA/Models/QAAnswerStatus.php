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
namespace Modules\QA\Models;

use phpOMS\Datatypes\Enum;

/**
 * QA answer status enum.
 *
 * @category   QA
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class QAAnswerStatus extends Enum
{
    /* public */ const ACTIVE = 1;

    /* public */ const INACTIVE = 2;

    /* public */ const BLOCKED = 4;
}
