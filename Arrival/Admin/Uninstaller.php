<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types = 1);

namespace Modules\Arrival\Admin;

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
            'arrival_status',
            'arrival'
        );

        $dbPool->get()->con->prepare($query->toSql())->execute();
    }
}