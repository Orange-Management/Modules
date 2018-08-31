<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Admin\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Admin install class.
 *
 * @package    Modules\Admin\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Installer extends InstallerAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function install(DatabasePool $dbPool, InfoManager $info) : void
    {
        parent::install($dbPool, $info);

        switch ($dbPool->get()->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get()->con->beginTransaction();

                /* Create group table */
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'group` (
                            `group_id` int(11) NOT NULL AUTO_INCREMENT,
                            `group_name` varchar(50) NOT NULL,
                            `group_status` int(3) NOT NULL,
                            `group_desc` text DEFAULT NULL,
                            `group_desc_raw` text DEFAULT NULL,
                            `group_created` datetime DEFAULT NULL,
                            PRIMARY KEY (`group_id`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                /* Create group permission table */
                /*
                 * idx = module specific element id (since one module can have multiple things that need permissions)
                 * e.g.
                 * id1 = report_template (since it could also be a permission for a report)
                 * id2 = report_template_id
                 */
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'group_permission` (
                            `group_permission_id` int(11) NOT NULL AUTO_INCREMENT,
                            `group_permission_group` int(11) NOT NULL,
                            `group_permission_unit` int(11) DEFAULT NULL,
                            `group_permission_app` varchar(255) DEFAULT NULL,
                            `group_permission_module` int(11) DEFAULT NULL,
                            `group_permission_from` int(11) DEFAULT NULL,
                            `group_permission_type` int(11) DEFAULT NULL,
                            `group_permission_element` int(11) DEFAULT NULL,
                            `group_permission_component` int(11) DEFAULT NULL,
                            `group_permission_permission` int(11) DEFAULT NULL,
                            PRIMARY KEY (`group_permission_id`),
                            KEY `group_permission_group` (`group_permission_group`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'group_permission`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'group_permission_ibfk_1` FOREIGN KEY (`group_permission_group`) REFERENCES `' . $dbPool->get()->prefix . 'group` (`group_id`);'
                )->execute();

                /* Create ips table
                   This gets used in order to prevent unauthorized access for user group. */
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'ips` (
                            `ips_id` int(11) NOT NULL AUTO_INCREMENT,
                            `ips_begin` bigint(20) NOT NULL,
                            `ips_end` bigint(20) NOT NULL,
                            `ips_group` int(11) DEFAULT NULL,
                            PRIMARY KEY (`ips_id`),
                            KEY `ips_group` (`ips_group`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'ips`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'ips_ibfk_1` FOREIGN KEY (`ips_group`) REFERENCES `' . $dbPool->get()->prefix . 'group` (`group_id`);'
                )->execute();

                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'l11n` (
                            `l11n_id` int(11) NOT NULL AUTO_INCREMENT,
                            `l11n_country` varchar(20) NOT NULL,
                            `l11n_language` varchar(20) NOT NULL,
                            `l11n_currency` varchar(20) NOT NULL,
                            `l11n_number_thousand` varchar(20) NOT NULL,
                            `l11n_number_decimal` varchar(20) NOT NULL,
                            `l11n_angle` varchar(20) NOT NULL,
                            `l11n_temperature` varchar(20) NOT NULL,
                            `l11n_weight_very_light` varchar(20) NOT NULL,
                            `l11n_weight_light` varchar(20) NOT NULL,
                            `l11n_weight_medium` varchar(20) NOT NULL,
                            `l11n_weight_heavy` varchar(20) NOT NULL,
                            `l11n_weight_very_heavy` varchar(20) NOT NULL,
                            `l11n_speed_very_slow` varchar(20) NOT NULL,
                            `l11n_speed_slow` varchar(20) NOT NULL,
                            `l11n_speed_medium` varchar(20) NOT NULL,
                            `l11n_speed_fast` varchar(20) NOT NULL,
                            `l11n_speed_very_fast` varchar(20) NOT NULL,
                            `l11n_speed_sea` varchar(20) NOT NULL,
                            `l11n_length_very_short` varchar(20) NOT NULL,
                            `l11n_length_short` varchar(20) NOT NULL,
                            `l11n_length_medium` varchar(20) NOT NULL,
                            `l11n_length_long` varchar(20) NOT NULL,
                            `l11n_length_very_long` varchar(20) NOT NULL,
                            `l11n_length_sea` varchar(20) NOT NULL,
                            `l11n_area_very_small` varchar(20) NOT NULL,
                            `l11n_area_small` varchar(20) NOT NULL,
                            `l11n_area_medium` varchar(20) NOT NULL,
                            `l11n_area_large` varchar(20) NOT NULL,
                            `l11n_area_very_large` varchar(20) NOT NULL,
                            `l11n_volume_very_small` varchar(20) NOT NULL,
                            `l11n_volume_small` varchar(20) NOT NULL,
                            `l11n_volume_medium` varchar(20) NOT NULL,
                            `l11n_volume_large` varchar(20) NOT NULL,
                            `l11n_volume_very_large` varchar(20) NOT NULL,
                            `l11n_volume_teaspoon` varchar(20) NOT NULL,
                            `l11n_volume_tablespoon` varchar(20) NOT NULL,
                            `l11n_volume_glass` varchar(20) NOT NULL,
                            PRIMARY KEY (`l11n_id`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                /* Create account table */
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'account` (
                            `account_id` int(11) NOT NULL AUTO_INCREMENT,
                            `account_status` tinyint(2) NOT NULL,
                            `account_type` tinyint(2) NOT NULL,
                            `account_login` varchar(30) NOT NULL,
                            `account_name1` varchar(50) NOT NULL,
                            `account_name2` varchar(50) NOT NULL,
                            `account_name3` varchar(50) NOT NULL,
                            `account_password` varchar(64) DEFAULT NULL,
                            `account_password_temp` varchar(64) DEFAULT NULL,
                            `account_email` varchar(70) NOT NULL,
                            `account_tries` tinyint(2) NOT NULL DEFAULT 0,
                            `account_lactive` datetime DEFAULT NULL,
                            `account_localization` int(11) DEFAULT NULL,
                            `account_created_at` datetime NOT NULL,
                            PRIMARY KEY (`account_id`),
                            KEY `account_localization` (`account_localization`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'account`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'account_ibfk_1` FOREIGN KEY (`account_localization`) REFERENCES `' . $dbPool->get()->prefix . 'l11n` (`l11n_id`);'
                )->execute();

                /* Create account group table */
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'account_group` (
                            `account_group_id` bigint(20) NOT NULL AUTO_INCREMENT,
                            `account_group_group` int(11) NOT NULL,
                            `account_group_account` int(11) NOT NULL,
                            PRIMARY KEY (`account_group_id`),
                            KEY `account_group_group` (`account_group_group`),
                            KEY `account_group_account` (`account_group_account`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'account_group`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'account_group_ibfk_1` FOREIGN KEY (`account_group_group`) REFERENCES `' . $dbPool->get()->prefix . 'group` (`group_id`),
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'account_group_ibfk_2` FOREIGN KEY (`account_group_account`) REFERENCES `' . $dbPool->get()->prefix . 'account` (`account_id`);'
                )->execute();

                /* Create account permission table */
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'account_permission` (
                            `account_permission_id` int(11) NOT NULL AUTO_INCREMENT,
                            `account_permission_account` int(11) NOT NULL,
                            `account_permission_unit` int(11) DEFAULT NULL,
                            `account_permission_app` int(11) DEFAULT NULL,
                            `account_permission_module` int(11) DEFAULT NULL,
                            `account_permission_from` int(11) DEFAULT NULL,
                            `account_permission_type` int(11) DEFAULT NULL,
                            `account_permission_element` int(11) DEFAULT NULL,
                            `account_permission_component` int(11) DEFAULT NULL,
                            `account_permission_permission` int(11) DEFAULT NULL,
                            PRIMARY KEY (`account_permission_id`),
                            KEY `account_permission_account` (`account_permission_account`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'account_permission`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'account_permission_ibfk_1` FOREIGN KEY (`account_permission_account`) REFERENCES `' . $dbPool->get()->prefix . 'account` (`account_id`);'
                )->execute();

                /* Create account settings table */
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'account_settings` (
                            `account_settings_id` int(11) NOT NULL AUTO_INCREMENT,
                            `account_settings_name` varchar(30) NOT NULL,
                            `account_settings_content` varchar(250) NOT NULL,
                            `account_settings_account` int(11) NOT NULL,
                            PRIMARY KEY (`account_settings_id`),
                            UNIQUE KEY `account_settings_name` (`account_settings_name`),
                            KEY `account_settings_account` (`account_settings_account`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'account_settings`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'account_settings_ibfk_1` FOREIGN KEY (`account_settings_account`) REFERENCES `' . $dbPool->get()->prefix . 'account` (`account_id`);'
                )->execute();

                /* Create settings table */
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'settings` (
                            `settings_id` int(11) NOT NULL AUTO_INCREMENT,
                            `settings_module` varchar(255) DEFAULT NULL,
                            `settings_name` varchar(100) NOT NULL,
                            `settings_content` varchar(255) NOT NULL,
                            `settings_group` int(11) DEFAULT NULL,
                            PRIMARY KEY (`settings_id`),
                            KEY `settings_module` (`settings_module`),
                            KEY `settings_group` (`settings_group`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'settings`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'settings_ibfk_1` FOREIGN KEY (`settings_module`) REFERENCES `' . $dbPool->get()->prefix . 'module` (`module_id`),
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'settings_ibfk_2` FOREIGN KEY (`settings_group`) REFERENCES `' . $dbPool->get()->prefix . 'group` (`group_id`);'
                )->execute();

                $dbPool->get()->con->commit();
                break;
        }
    }

    /**
     * Provide group and permission install for other modules
     *
     * @param DatabasePool $dbPool Database pool
     * @param array        $data   Data to install
     *
     * @return  void
     *
     * @since  1.0.0
     */
    public static function installExternal(DatabasePool $dbPool, array $data) : void
    {
        foreach ($data as $type => $element) {
            if ($type === InstallType::GROUP) {
                self::installGroup($dbPool, $element);
            }
        }
    }

    /**
     * Install group
     *
     * @param DatabasePool $dbPool Database pool
     * @param array        $data   Data to install
     *
     * @return int
     *
     * @since  1.0.0
     */
    public static function installGroup(DatabasePool $dbPool, array $data) : int
    {
        $sth = $dbPool->get()->con->prepare(
            'INSERT INTO `' . $dbPool->get()->prefix . 'group` (
                `group_id`, `group_name`, `group_description`, `group_description_raw`, `group_status`, `group_created`) 
                VALUES (:id, :name, :desc, :desc_raw, :status, :created);'
        );

        $sth->bindValue(':id', $data['id'] ?? 0, \PDO::PARAM_INT);
        $sth->bindValue(':name', $data['name'] ?? '', \PDO::PARAM_STR);
        $sth->bindValue(':desc', $data['desc'] ?? '', \PDO::PARAM_STR);
        $sth->bindValue(':desc_raw', $data['desc_raw'] ?? '', \PDO::PARAM_STR);
        $sth->bindValue(':status', $data['status'] ?? 1, \PDO::PARAM_INT);
        $sth->bindValue(':created', (new \DateTime('now'))->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $sth->execute();

        $lastInsertID = $dbPool->get()->con->lastInsertId();

        return $lastInsertID;
    }
}
