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
namespace Modules\AreaManager\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\UninstallAbstract;

/**
 * Navigation class.
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Uninstall extends UninstallAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function uninstall(DatabasePool $dbPool, InfoManager $info)
    {
        parent::uninstall($dbPool, $info);

        $query = new Builder($dbPool->get());

        $query->prefix($dbPool->get('core')->getPrefix())->drop(
            'area_manager_account',
            'area_manager_area'
        );

        $dbPool->get()->con->prepare($query->toSql())->execute();
    }
}
