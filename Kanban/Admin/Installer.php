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
namespace Modules\Job\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
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
    public static function install(string $path, DatabasePool $dbPool, InfoManager $info)
    {
        parent::install($path, $dbPool, $info);

        switch ($dbPool->get('core')->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'kanban_board` (
                            `kanban_board_id` int(11) NOT NULL AUTO_INCREMENT,
                            `kanban_board_name` varchar(50) NOT NULL,
                            `kanban_board_status` int(11) NOT NULL,
                            `kanban_board_desc` varchar(100) DEFAULT NULL,
                            `kanban_board_created_at` datetime DEFAULT NULL,
                            `kanban_board_created_by` int(11) DEFAULT NULL,
                            PRIMARY KEY (`kanban_board_id`),
                            KEY `kanban_board_created_by` (`kanban_board_created_by`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'kanban_column` (
                            `kanban_column_id` int(11) NOT NULL AUTO_INCREMENT,
                            `kanban_column_name` varchar(50) NOT NULL,
                            `kanban_column_order` int(11) NOT NULL,
                            `kanban_column_board` int(11) NOT NULL,
                            PRIMARY KEY (`kanban_column_id`),
                            KEY `kanban_column_board` (`kanban_column_board`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'kanban_card` (
                            `kanban_card_id` int(11) NOT NULL AUTO_INCREMENT,
                            `kanban_card_name` varchar(50) NOT NULL,
                            `kanban_card_description` text NOT NULL,
                            `kanban_card_type` int(2) NOT NULL,
                            `kanban_card_status` int(2) NOT NULL,
                            `kanban_card_ref` int(11) NOT NULL,
                            `kanban_card_column` int(11) NOT NULL,
                            `kanban_card_media` int(11) NOT NULL,
                            `kanban_card_created_at` datetime DEFAULT NULL,
                            `kanban_card_created_by` int(11) DEFAULT NULL,
                            PRIMARY KEY (`kanban_card_id`),
                            KEY `kanban_card_column` (`kanban_card_column`),
                            KEY `kanban_card_created_by` (`kanban_card_created_by`),
                            KEY `kanban_card_media` (`kanban_card_created_by`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                // Task comments and these comments need to be merged which is bad but not every kanban card is a task and task info should be here as well.
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'kanban_card_comment` (
                            `kanban_card_comment_id` int(11) NOT NULL AUTO_INCREMENT,
                            `kanban_card_comment_description` text NOT NULL,
                            `kanban_card_comment_created_at` datetime DEFAULT NULL,
                            `kanban_card_comment_created_by` int(11) DEFAULT NULL,
                            `kanban_card_comment_media` int(11) DEFAULT NULL,
                            PRIMARY KEY (`kanban_card_comment_id`),
                            KEY `kanban_card_comment_column` (`kanban_card_comment_column`),
                            KEY `kanban_card_comment_created_by` (`kanban_card_comment_created_by`),
                            KEY `kanban_card_comment_media` (`kanban_card_comment_media`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'kanban_activity` (
                            `kanban_activity_id` int(11) NOT NULL AUTO_INCREMENT,
                            `kanban_activity_type` varchar(50) NOT NULL,
                            `kanban_activity_subtype` int(2) NOT NULL,
                            `kanban_activity_board` int(11) NOT NULL,
                            `kanban_activity_old` varchar(255) NOT NULL,
                            `kanban_activity_new` varchar(255) NOT NULL,
                            `kanban_activity_by` int(11) DEFAULT NULL,
                            PRIMARY KEY (`kanban_activity_id`),
                            KEY `kanban_activity` (`kanban_activity`),
                            KEY `kanban_activity_by` (`kanban_activity_by`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'kanban_label` (
                            `kanban_label_id` int(11) NOT NULL AUTO_INCREMENT,
                            `kanban_label_name` varchar(50) NOT NULL,
                            `kanban_label_color` int(11) NOT NULL,
                            `kanban_label_board` int(11) NOT NULL,
                            PRIMARY KEY (`kanban_label_id`),
                            KEY `kanban_label_board` (`kanban_label_board`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'kanban_label_relation` (
                            `kanban_label_relation_id` int(11) NOT NULL AUTO_INCREMENT,
                            `kanban_label_relation_card` int(11) NOT NULL,
                            `kanban_label_relation_label` int(11) NOT NULL,
                            PRIMARY KEY (`kanban_label_relation_id`),
                            KEY `kanban_label_relation_card` (`kanban_label_relation_card`),
                            KEY `kanban_label_relation_label` (`kanban_label_relation_label`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'kanban_permission` (
                            `kanban_permission_id` int(11) NOT NULL AUTO_INCREMENT,
                            `kanban_permission_permission` int(11) NOT NULL,
                            `kanban_permission_board` int(11) NOT NULL,
                            `kanban_permission_account` int(11) NOT NULL,
                            PRIMARY KEY (`kanban_permission_id`),
                            KEY `kanban_permission_board` (`kanban_permission_board`),
                            KEY `kanban_permission_account` (`kanban_permission_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();
                break;
        }
    }
}
