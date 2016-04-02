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
namespace Modules\EventManagement\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\Pool;
use phpOMS\Module\InstallerAbstract;

/**
 * Event Management install class.
 *
 * @category   Modules
 * @package    Modules\EventManagement
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
    public static function install(Pool $dbPool, InfoManager $info)
    {
        parent::install($dbPool, $info);

        switch ($dbPool->get('core')->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'eventmanagement_event` (
                            `eventmanagement_event_id` int(11) NOT NULL AUTO_INCREMENT,
                            `eventmanagement_event_type` tinyint(2) NOT NULL,
                            `eventmanagement_event_event` int(11) NOT NULL,
                            `eventmanagement_event_costs` int(11) NOT NULL,
                            `eventmanagement_event_budget` int(11) NOT NULL,
                            `eventmanagement_event_earnings` int(11) NOT NULL,
                            PRIMARY KEY (`eventmanagement_event_id`),
                            KEY `eventmanagement_event_event` (`eventmanagement_event_event`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'eventmanagement_event`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'eventmanagement_event_ibfk_1` FOREIGN KEY (`eventmanagement_event_event`) REFERENCES `' . $dbPool->get('core')->prefix . 'calendar_event` (`calendar_event_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'eventmanagement_task_relation` (
                            `eventmanagement_task_relation_id` int(11) NOT NULL AUTO_INCREMENT,
                            `eventmanagement_task_relation_src`  int(11) NULL,
                            `eventmanagement_task_relation_dst` int(11) NULL,
                            PRIMARY KEY (`eventmanagement_task_relation_id`),
                            KEY `eventmanagement_task_relation_src` (`eventmanagement_task_relation_src`),
                            KEY `eventmanagement_task_relation_dst` (`eventmanagement_task_relation_dst`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'eventmanagement_task_relation`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'eventmanagement_task_relation_ibfk_1` FOREIGN KEY (`eventmanagement_task_relation_src`) REFERENCES `' . $dbPool->get('core')->prefix . 'task` (`task_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'eventmanagement_task_relation_ibfk_2` FOREIGN KEY (`eventmanagement_task_relation_dst`) REFERENCES `' . $dbPool->get('core')->prefix . 'eventmanagement_event` (`eventmanagement_event_id`);'
                )->execute();
                break;
        }
    }
}
