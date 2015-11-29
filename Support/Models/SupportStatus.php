<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Support;

use phpOMS\Datatypes\Enum;

/**
 * Support status enum.
 *
 * @category   Support
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class SupportStatus extends Enum
{
    const OPEN = 0;

    const REVIEW = 1;

    const LIVE = 2;

    const UNSOLVABLE = 3;

    const SOLVED = 4;

    const CLOSED = 5;
}
