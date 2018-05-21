<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Exchange
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Exchange\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InstallerAbstract;
use phpOMS\Module\InfoManager;
use phpOMS\System\File\Local\Directory;

use Modules\Exchange\Models\InterfaceManager;
use Modules\Exchange\Models\InterfaceManagerMapper;

/**
 * Exchange install class.
 *
 * @package    Modules\Exchange
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'exchange` (
                            `exchange_id` int(11) NOT NULL AUTO_INCREMENT,
                            `exchange_title` varchar(255) DEFAULT NULL,
                            `exchange_path` text NOT NULL,
                            `exchange_import` tinyint(1) NOT NULL,
                            `exchange_export` tinyint(1) NOT NULL,
                            `exchange_version` varchar(255) NOT NULL,
                            `exchange_website` varchar(255) NOT NULL,
                            `exchange_created_by` int(11) DEFAULT NULL,
                            `exchange_created_at` datetime DEFAULT NULL,
                            PRIMARY KEY (`exchange_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->commit();
                break;
        }

        $interfaces = Directory::list(__DIR__ . '/../Interfaces', '.*interface\.json');

        foreach ($interfaces as $interface) {
            $exchange = new InterfaceManager(__DIR__ . '/../Interfaces/' . $interface);
            $exchange->load();

            InterfaceManagerMapper::create($exchange);
        }
    }
}
