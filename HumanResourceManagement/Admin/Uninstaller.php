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

namespace Modules\HumanResourceManagement\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\Schema\Builder;
use phpOMS\Module\UninstallerAbstract;
use phpOMS\Module\InfoManager;

/**
 * Navigation class.
 *
 * @package    Modules
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Uninstaller extends UninstallerAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function uninstall(DatabasePool $dbPool, InfoManager $info)
    {
        parent::uninstall($dbPool, $info);

        $query = new Builder($dbPool->get());

        $query->prefix($dbPool->get()->getPrefix())->drop(
            'hr_planning_staff',
            'hr_planning_shift',
            'hr_staff_contract',
            'hr_staff_history',
            'hr_staff'
        );

        $dbPool->get()->con->prepare($query->toSql())->execute();
    }
}
