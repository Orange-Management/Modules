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
namespace Modules\Workflow\Templates\Permission;

use phpOMS\Datatypes\Enum;

/**
 * Task status enum.
 *
 * @category   Tasks
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class States extends Enum
{
    /* public */ const DEFAULT = 0;
    /* public */ const PENDING = 1;
    /* public */ const APPROVED = 2;
    /* public */ const DISMISSED = 3;
}
