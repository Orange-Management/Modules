<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Monitoring\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Monitoring\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Monitoring install class.
 *
 * @package    Modules\Monitoring\Admin
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

                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'monitoring_file` (
                            `monitoring_file_id` int(11) NOT NULL AUTO_INCREMENT,
                            `monitoring_file_path` text DEFAULT NULL,
                            `monitoring_file_modified` datetime NOT NULL,
                            `monitoring_file_deprecated` tinyint(1) NOT NULL,
                            `monitoring_file_dangerous` tinyint(1) NOT NULL,
                            `monitoring_file_unicode` tinyint(1) NOT NULL,
                            `monitoring_file_version` tinyint(1) NOT NULL,
                            `monitoring_file_hash` tinyint(1) NOT NULL,
                            `monitoring_file_status` tinyint(1) NOT NULL,
                            `monitoring_file_inspected` datetime NOT NULL,
                            PRIMARY KEY (`monitoring_file_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->commit();
                break;
        }
    }
}
