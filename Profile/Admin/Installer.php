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
namespace Modules\Profile\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Navigation class.
 *
 * @category   Modules
 * @package    Framework
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
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'profile_account` (
                            `profile_account_id` int(11) NOT NULL,
                            `profile_account_begin` datetime NOT NULL,
                            `profile_account_image` varchar(255) NOT NULL,
                            `profile_account_birthday` varchar(255) NOT NULL,
                            `profile_account_cv` text NOT NULL,
                            `profile_account_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`profile_account_id`),
                            KEY `profile_account_account` (`profile_account_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'profile_account`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'profile_account_ibfk_1` FOREIGN KEY (`profile_account_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                // real contacts that you also save in your email contact list. this is to store other accounts
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'profile_contact` (
                            `profile_contact_id` int(11) NOT NULL,
                            `profile_contact_name1` varchar(250) NOT NULL,
                            `profile_contact_name2` varchar(250) NOT NULL,
                            `profile_contact_name3` varchar(250) NOT NULL,
                            `profile_contact_company` varchar(250) NOT NULL,
                            `profile_contact_company_job` varchar(250) NOT NULL,
                            `profile_contact_address` varchar(250) NOT NULL,
                            `profile_contact_website` varchar(250) NOT NULL,
                            `profile_contact_birthday` varchar(11) NOT NULL,
                            `profile_contact_description` text NOT NULL,
                            `profile_contact_account` int(11) NOT NULL,
                            PRIMARY KEY (`profile_contact_id`),
                            KEY `profile_contact_account` (`profile_contact_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'profile_contact`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'profile_contact_ibfk_1` FOREIGN KEY (`profile_contact_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'profile_account` (`profile_account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'profile_contact_element` (
                            `profile_contact_element_id` int(11) NOT NULL,
                            `profile_contact_element_type` tinyint(2) NOT NULL,
                            `profile_contact_element_subtype` tinyint(2) NOT NULL,
                            `profile_contact_element_content` varchar(50) NOT NULL,
                            `profile_contact_element_contact` int(11) NOT NULL,
                            PRIMARY KEY (`profile_contact_element_id`),
                            KEY `profile_contact_element_account` (`profile_contact_element_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'profile_contact_element`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'profile_contact_element_ibfk_1` FOREIGN KEY (`profile_contact_element_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'profile_contact` (`profile_contact_id`);'
                )->execute();

                // not a full contact only the element like email, phone etc. for the accounts themselves
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'profile_contactelement` (
                            `profile_contactelement_id` int(11) NOT NULL,
                            `profile_contactelement_type` tinyint(2) NOT NULL,
                            `profile_contactelement_subtype` tinyint(2) NOT NULL,
                            `profile_contactelement_content` varchar(50) NOT NULL,
                            `profile_contactelement_account` int(11) NOT NULL,
                            PRIMARY KEY (`profile_contactelement_id`),
                            KEY `profile_contactelement_account` (`profile_contactelement_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'profile_contactelement`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'profile_contactelement_ibfk_1` FOREIGN KEY (`profile_contactelement_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'profile_address` (
                            `profile_address_id` int(11) NOT NULL,
                            `profile_address_type` tinyint(2) NOT NULL,
                            `profile_address_address` varchar(50) NOT NULL,
                            `profile_address_street` varchar(50) NOT NULL,
                            `profile_address_city` varchar(50) NOT NULL,
                            `profile_address_zip` varchar(50) NOT NULL,
                            `profile_address_country` varchar(50) NOT NULL,
                            `profile_address_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`profile_address_id`),
                            KEY `profile_address_account` (`profile_address_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'profile_address`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'profile_address_ibfk_1` FOREIGN KEY (`profile_address_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'profile_account_relation` (
                            `profile_account_relation_id` int(11) NOT NULL,
                            `profile_account_relation_type` tinyint(2) NOT NULL,
                            `profile_account_relation_relation` int(11) DEFAULT NULL,
                            `profile_account_relation_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`profile_account_relation_id`),
                            KEY `profile_account_relation_account` (`profile_account_relation_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'profile_account_relation`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'profile_account_relation_ibfk_1` FOREIGN KEY (`profile_account_relation_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'profile_account_setting` (
                            `profile_account_setting_id` int(11) NOT NULL,
                            `profile_account_setting_module` int(11) NOT NULL,
                            `profile_account_setting_type` varchar(20) NOT NULL,
                            `profile_account_setting_value` varchar(32) DEFAULT NULL,
                            `profile_account_setting_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`profile_account_setting_id`),
                            KEY `profile_account_setting_account` (`profile_account_setting_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'profile_account_setting`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'profile_account_setting_ibfk_1` FOREIGN KEY (`profile_account_setting_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();
                break;
        }
    }
}
