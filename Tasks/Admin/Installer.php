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
namespace Modules\Tasks\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\Pool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Tasks install class.
 *
 * @category   Modules
 * @package    Modules\Tasks
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
                $dbPool->get('core')->con->beginTransaction();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'task` (
                            `task_id` int(11) NOT NULL AUTO_INCREMENT,
                            `task_title` varchar(60) DEFAULT NULL,
                            `task_desc` text NOT NULL,
                            `task_type` tinyint(1) NOT NULL,
                            `task_status` tinyint(1) NOT NULL,
                            `task_due` datetime NOT NULL,
                            `task_done` datetime DEFAULT NULL,
                            `task_schedule` int(11) DEFAULT NULL,
                            `task_created_by` int(11) NOT NULL,
                            `task_created_at` datetime NOT NULL,
                            PRIMARY KEY (`task_id`),
                            KEY `task_schedule` (`task_schedule`),
                            KEY `task_created_by` (`task_created_by`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'task`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_ibfk_1` FOREIGN KEY (`task_schedule`) REFERENCES `' . $dbPool->get('core')->prefix . 'schedule` (`schedule_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_ibfk_2` FOREIGN KEY (`task_created_by`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'task_media` (
                            `task_media_id` int(11) NOT NULL AUTO_INCREMENT,
                            `task_media_src`  int(11) NULL,
                            `task_media_dst` int(11) NULL,
                            PRIMARY KEY (`task_media_id`),
                            KEY `task_media_src` (`task_media_src`),
                            KEY `task_media_dst` (`task_media_dst`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'task_media`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_media_ibfk_1` FOREIGN KEY (`task_media_src`) REFERENCES `' . $dbPool->get('core')->prefix . 'task` (`task_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_media_ibfk_2` FOREIGN KEY (`task_media_dst`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'task_account` (
                            `task_account_id` int(11) NOT NULL AUTO_INCREMENT,
                            `task_account_task` int(11) NOT NULL,
                            `task_account_seen` tinyint(1) NOT NULL,
                            `task_account_account` int(11) NOT NULL,
                            `task_account_type` tinyint(1) NOT NULL,
                            PRIMARY KEY (`task_account_id`),
                            KEY `task_account_task` (`task_account_task`),
                            KEY `task_account_account` (`task_account_account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'task_account`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_account_ibfk_1` FOREIGN KEY (`task_account_task`) REFERENCES `' . $dbPool->get('core')->prefix . 'task` (`task_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_account_ibfk_2` FOREIGN KEY (`task_account_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'task_element` (
                            `task_element_id` int(11) NOT NULL AUTO_INCREMENT,
                            `task_element_desc` text NOT NULL,
                            `task_element_task` int(11) NOT NULL,
                            `task_element_created_by` int(11) NOT NULL,
                            `task_element_status` tinyint(1) NOT NULL,
                            `task_element_due` datetime NOT NULL,
                            `task_element_forwarded` int(11) DEFAULT NULL,
                            `task_element_created_at` datetime NOT NULL,
                            PRIMARY KEY (`task_element_id`),
                            KEY `task_element_task` (`task_element_task`),
                            KEY `task_element_created_by` (`task_element_created_by`),
                            KEY `task_element_forwarded` (`task_element_forwarded`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'task_element`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_element_ibfk_1` FOREIGN KEY (`task_element_task`) REFERENCES `' . $dbPool->get('core')->prefix . 'task` (`task_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_element_ibfk_2` FOREIGN KEY (`task_element_created_by`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_element_ibfk_3` FOREIGN KEY (`task_element_forwarded`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'task_element_media` (
                            `task_element_media_id` int(11) NOT NULL AUTO_INCREMENT,
                            `task_element_media_src`  int(11) NULL,
                            `task_element_media_dst` int(11) NULL,
                            PRIMARY KEY (`task_element_media_id`),
                            KEY `task_element_media_src` (`task_element_media_src`),
                            KEY `task_element_media_dst` (`task_element_media_dst`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'task_element_media`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_element_media_ibfk_1` FOREIGN KEY (`task_element_media_src`) REFERENCES `' . $dbPool->get('core')->prefix . 'task_element` (`task_element_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_element_media_ibfk_2` FOREIGN KEY (`task_element_media_dst`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`);'
                )->execute();

                $dbPool->get('core')->con->commit();
                break;
        }
    }
}
