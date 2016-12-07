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
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\ProjectManagement\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Project Management install class.
 *
 * @category   Modules
 * @package    Modules\ProjectManagement
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'projectmanagement_project` (
                            `projectmanagement_project_id` int(11) NOT NULL AUTO_INCREMENT,
                            `projectmanagement_project_name` varchar(254) NOT NULL,
                            `projectmanagement_project_description` text NOT NULL,
                            `projectmanagement_project_calendar` int(11) NOT NULL,
                            `projectmanagement_project_costs` int(11) NOT NULL,
                            `projectmanagement_project_budget` int(11) NOT NULL,
                            `projectmanagement_project_earnings` int(11) NOT NULL,
                            `projectmanagement_project_start` datetime NOT NULL,
                            `projectmanagement_project_end` datetime NOT NULL,
                            PRIMARY KEY (`projectmanagement_project_id`),
                            KEY `projectmanagement_project_calendar` (`projectmanagement_project_calendar`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'projectmanagement_project`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'projectmanagement_project_ibfk_1` FOREIGN KEY (`projectmanagement_project_calendar`) REFERENCES `' . $dbPool->get('core')->prefix . 'calendar` (`calendar_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'projectmanagement_task_relation` (
                            `projectmanagement_task_relation_id` int(11) NOT NULL AUTO_INCREMENT,
                            `projectmanagement_task_relation_src`  int(11) NULL,
                            `projectmanagement_task_relation_dst` int(11) NULL,
                            PRIMARY KEY (`projectmanagement_task_relation_id`),
                            KEY `projectmanagement_task_relation_src` (`projectmanagement_task_relation_src`),
                            KEY `projectmanagement_task_relation_dst` (`projectmanagement_task_relation_dst`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'projectmanagement_task_relation`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'projectmanagement_task_relation_ibfk_1` FOREIGN KEY (`projectmanagement_task_relation_src`) REFERENCES `' . $dbPool->get('core')->prefix . 'task` (`task_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'projectmanagement_task_relation_ibfk_2` FOREIGN KEY (`projectmanagement_task_relation_dst`) REFERENCES `' . $dbPool->get('core')->prefix . 'projectmanagement_project` (`projectmanagement_project_id`);'
                )->execute();
                break;
        }
    }
}
