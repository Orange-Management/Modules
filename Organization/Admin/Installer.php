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
namespace Modules\Organization\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\Pool;
use phpOMS\Module\InstallerAbstract;

/**
 * Organization install class.
 *
 * @category   Modules
 * @package    Modules\Organization
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
    public static function install(Pool $dbPool, array $info)
    {
        parent::install($dbPool, $info);

        switch ($dbPool->get('core')->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'organization_unit` (
                            `organization_unit_id` int(11) NOT NULL AUTO_INCREMENT,
                            `organization_unit_status` tinyint(2) DEFAULT NULL,
                            `organization_unit_matchcode` varchar(50) DEFAULT NULL,
                            `organization_unit_name` varchar(50) DEFAULT NULL,
                            `organization_unit_description` varchar(255) DEFAULT NULL,
                            `organization_unit_parent` int(11) DEFAULT NULL,
                            `organization_unit_created` datetime DEFAULT NULL,
                            PRIMARY KEY (`organization_unit_id`),
                            KEY `organization_unit_parent` (`organization_unit_parent`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'organization_unit`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'organization_unit_ibfk_1` FOREIGN KEY (`organization_unit_parent`) REFERENCES `' . $dbPool->get('core')->prefix . 'organization_unit` (`organization_unit_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'organization_department` (
                            `organization_department_id` int(11) NOT NULL AUTO_INCREMENT,
                            `organization_department_name` varchar(30) DEFAULT NULL,
                            `organization_department_description` varchar(255) DEFAULT NULL,
                            `organization_department_parent` int(11) DEFAULT NULL,
                            `organization_department_unit` int(11) NOT NULL,
                            PRIMARY KEY (`organization_department_id`),
                            KEY `organization_department_parent` (`organization_department_parent`),
                            KEY `organization_department_unit` (`organization_department_unit`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'organization_department`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'organization_department_ibfk_1` FOREIGN KEY (`organization_department_parent`) REFERENCES `' . $dbPool->get('core')->prefix . 'organization_department` (`organization_department_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'organization_department_ibfk_2` FOREIGN KEY (`organization_department_unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'organization_unit` (`organization_unit_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'organization_address` (
                            `organization_address_id` int(11) NOT NULL AUTO_INCREMENT,
                            `organization_address_status` tinyint(2) DEFAULT NULL,
                            `organization_address_matchcode` varchar(50) DEFAULT NULL,
                            `organization_address_name` varchar(50) DEFAULT NULL,
                            `organization_address_fao` varchar(30) DEFAULT NULL,
                            `organization_address_addr` varchar(50) DEFAULT NULL,
                            `organization_address_city` varchar(20) DEFAULT NULL,
                            `organization_address_zip` varchar(20) DEFAULT NULL,
                            `organization_address_state` varchar(20) DEFAULT NULL,
                            `organization_address_country` varchar(30) DEFAULT NULL,
                            `organization_address_unit` int(11) DEFAULT NULL,
                            PRIMARY KEY (`organization_address_id`),
                            KEY `organization_address_unit` (`organization_address_unit`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'organization_address`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'organization_address_ibfk_1` FOREIGN KEY (`organization_address_unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'organization_unit` (`organization_unit_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'INSERT INTO `' . $dbPool->get('core')->prefix . 'organization_unit` (`organization_unit_status`, `organization_unit_matchcode`, `organization_unit_name`, `organization_unit_description`, `organization_unit_parent`) VALUES
                            (1, \'default\', \'Default\', \'Default unit.\', NULL);'
                )->execute();
                break;
        }
    }
}
