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
declare(strict_types=1);
namespace Modules\ClientManagement\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Client Management install class.
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Installer extends InstallerAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function install(string $path, DatabasePool $dbPool, InfoManager $info)
    {
        parent::install($path, $dbPool, $info);

        switch ($dbPool->get('core')->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get('core')->con->beginTransaction();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'clientmgmt_client` (
                            `clientmgmt_client_id` int(11) NOT NULL AUTO_INCREMENT,
                            `clientmgmt_client_no` int(11) NOT NULL,
                            `clientmgmt_client_no_reverse` int(11) NOT NULL,
                            `clientmgmt_client_status` tinyint(2) NOT NULL,
                            `clientmgmt_client_type` tinyint(2) NOT NULL,
                            `clientmgmt_client_TaxId` varchar(50) NOT NULL,
                            `clientmgmt_client_info` text NOT NULL,
                            `clientmgmt_client_created_at` datetime NOT NULL,
                            `clientmgmt_client_account` int(11) NOT NULL,
                            PRIMARY KEY (`clientmgmt_client_id`),
                            KEY `clientmgmt_client_account` (`clientmgmt_client_account`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'clientmgmt_client`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'clientmgmt_client_ibfk_1` FOREIGN KEY (`clientmgmt_client_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'profile_account` (`profile_account_id`);'
                )->execute();

                $dbPool->get('core')->con->commit();
                break;
        }
    }
}
