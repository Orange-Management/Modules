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
namespace Modules\Calendar\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\Pool;
use phpOMS\Module\InstallerAbstract;

/**
 * Calendar install class.
 *
 * @category   Modules
 * @package    Modules\Calendar
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'calendar` (
                            `calendar_id` int(11) NOT NULL AUTO_INCREMENT,
                            `calendar_name` varchar(25) NOT NULL,
                            `calendar_password` varchar(64) NOT NULL,
                            `calendar_description` varchar(255) NOT NULL,
                            `task_created_by` int(11) NOT NULL,
                            `task_created_at` datetime NOT NULL,
                            PRIMARY KEY (`calendar_id`),
                            KEY `task_created_by` (`task_created_by`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'calendar`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_ibfk_1` FOREIGN KEY (`task_created_by`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'calendar_permission` (
                            `calendar_permission_id` int(11) NOT NULL AUTO_INCREMENT,
                            `calendar_permission_type` tinyint(1) NOT NULL,
                            `calendar_permission_ref` int(11) NOT NULL,
                            `calendar_permission_calendar` int(11) NOT NULL,
                            `calendar_permission_permission` tinyint(2) NOT NULL,
                            PRIMARY KEY (`calendar_permission_id`),
                            KEY `calendar_permission_calendar` (`calendar_permission_calendar`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'calendar_permission`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_permission_ibfk_2` FOREIGN KEY (`calendar_permission_calendar`) REFERENCES `' . $dbPool->get('core')->prefix . 'calendar` (`calendar_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'calendar_event` (
                            `calendar_event_id` int(11) NOT NULL AUTO_INCREMENT,
                            `calendar_event_name` varchar(25) NOT NULL,
                            `calendar_event_description` varchar(255) NOT NULL,
                            `calendar_event_status` tinyint(1) NOT NULL,
                            `calendar_event_location` varchar(511) NOT NULL,
                            `calendar_event_created_by` int(11) NOT NULL,
                            `calendar_event_created_at` datetime NOT NULL,
                            `calendar_event_calendar` int(11) NOT NULL,
                            PRIMARY KEY (`calendar_event_id`),
                            KEY `calendar_event_created_by` (`calendar_event_created_by`),
                            KEY `calendar_event_calendar` (`calendar_event_calendar`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'calendar_event`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_event_ibfk_1` FOREIGN KEY (`calendar_event_created_by`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_event_ibfk_2` FOREIGN KEY (`calendar_event_calendar`) REFERENCES `' . $dbPool->get('core')->prefix . 'calendar` (`calendar_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'calendar_event_participant` (
                            `calendar_event_participant_id` int(11) NOT NULL AUTO_INCREMENT,
                            `calendar_event_participant_event` int(11) NOT NULL,
                            `calendar_event_participant_person` int(11) NOT NULL,
                            `calendar_event_participant_status` tinyint(1) NOT NULL,
                            PRIMARY KEY (`calendar_event_participant_id`),
                            KEY `calendar_event_participant_event` (`calendar_event_participant_event`),
                            KEY `calendar_event_participant_person` (`calendar_event_participant_person`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'calendar_event_participant`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_event_participant_ibfk_1` FOREIGN KEY (`calendar_event_participant_event`) REFERENCES `' . $dbPool->get('core')->prefix . 'calendar_event` (`calendar_event_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_event_participant_ibfk_2` FOREIGN KEY (`calendar_event_participant_person`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();
                break;
        }
    }
}
