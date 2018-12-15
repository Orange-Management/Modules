<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Draw\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Draw\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Calendar install class.
 *
 * @package    Modules\Draw\Admin
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
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'draw_image` (
                            `draw_image_id` int(11) NOT NULL AUTO_INCREMENT,
                            `draw_image_media` int(11) NOT NULL,
                            PRIMARY KEY (`draw_image_id`),
                            KEY `draw_image_media` (`draw_image_media`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'draw_image`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'draw_image_ibfk_1` FOREIGN KEY (`draw_image_media`) REFERENCES `' . $dbPool->get()->prefix . 'media` (`media_id`);'
                )->execute();
                break;
        }
    }
}
