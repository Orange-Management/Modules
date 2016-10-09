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
namespace Modules\Chat\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\Pool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Chat install class.
 *
 * @category   Modules
 * @package    Modules\Chat
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
    public static function install(string $path, Pool $dbPool, InfoManager $info)
    {
        parent::install($path, $dbPool, $info);

        switch ($dbPool->get('core')->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'chat_room` (
                            `chat_room_id` int(11) NOT NULL AUTO_INCREMENT,
                            `chat_room_name` varchar(25) NOT NULL,
                            `chat_room_password` varchar(64) NOT NULL,
                            `chat_room_description` varchar(255) NOT NULL,
                            `chat_room_creator` int(11) NOT NULL,
                            `chat_room_created` datetime NOT NULL,
                            PRIMARY KEY (`chat_room_id`),
                            KEY `chat_room_creator` (`chat_room_creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'chat_room`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'chat_room_ibfk_1` FOREIGN KEY (`chat_room_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'chat_room_permission` (
                            `chat_room_permission_id` int(11) NOT NULL AUTO_INCREMENT,
                            `chat_room_permission_account` int(11) NOT NULL,
                            `chat_room_permission_room` int(11) NOT NULL,
                            `chat_room_permission_permission` tinyint(1) NOT NULL,
                            PRIMARY KEY (`chat_room_permission_id`),
                            KEY `chat_room_permission_account` (`chat_room_permission_account`),
                            KEY `chat_room_permission_room` (`chat_room_permission_room`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'chat_room_permission`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'chat_room_permission_ibfk_1` FOREIGN KEY (`chat_room_permission_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'chat_room_permission_ibfk_2` FOREIGN KEY (`chat_room_permission_room`) REFERENCES `' . $dbPool->get('core')->prefix . 'chat_room` (`chat_room_id`);'
                )->execute();
                break;
        }
    }
}
