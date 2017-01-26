<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\CostCenterAccounting\Admin;


use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\ActivateAbstract;
use phpOMS\Module\InfoManager;

/**
 * Navigation class.
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Activate extends ActivateAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function activate(DatabasePool $dbPool, InfoManager $info)
    {
        parent::activate($dbPool, $info);
    }
}
