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
namespace Modules\Draw\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
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
    public static function install(string $path, DatabasePool $dbPool, InfoManager $info)
    {
        parent::install($path, $dbPool, $info);

        switch ($dbPool->get('core')->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'draw_image` (
                            `draw_image_id` int(11) NOT NULL AUTO_INCREMENT,
                            `draw_image_media` int(11) NOT NULL,
                            `draw_image_path` varchar(255) NOT NULL,
                            PRIMARY KEY (`draw_image_id`),
                            KEY `draw_image_media` (`draw_image_media`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'draw_image`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'draw_image_ibfk_1` FOREIGN KEY (`draw_image_media`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'editor_tag` (
                            `editor_tag_id` int(11) NOT NULL AUTO_INCREMENT,
                            `editor_tag_doc` int(11) NOT NULL,
                            `editor_tag_tag` varchar(20) NOT NULL,
                            PRIMARY KEY (`editor_tag_id`),
                            KEY `editor_tag_doc` (`editor_tag_doc`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'editor_tag`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'editor_tag_ibfk_1` FOREIGN KEY (`editor_tag_doc`) REFERENCES `' . $dbPool->get('core')->prefix . 'draw_image` (`draw_image_id`);'
                )->execute();
                break;
        }
    }
}
