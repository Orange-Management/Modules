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
namespace Modules\Comments\Admin;

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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'comments_list` (
                            `comments_list_id` int(11) NOT NULL AUTO_INCREMENT,
                            PRIMARY KEY (`comments_comment_id`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'comments_comment` (
                            `comments_comment_id` int(11) NOT NULL AUTO_INCREMENT,
                            `comments_comment_title` varchar(250) NOT NULL,
                            `comments_comment_content` text NOT NULL,
                            `comments_comment_lang` varchar(2) NOT NULL,
                            `comments_comment_list` int(11) NOT NULL,
                            `comments_comment_ref` int(11) DEFAULT NULL,
                            `comments_comment_created_at` datetime NOT NULL,
                            `comments_comment_created_by` int(11) NOT NULL,
                            PRIMARY KEY (`comments_comment_id`),
                            KEY `comments_comment_ref` (`comments_comment_ref`),
                            KEY `comments_comment_created_by` (`comments_comment_created_by`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'editor`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'comments_comment_ibfk_1` FOREIGN KEY (`comments_comment_list`) REFERENCES `' . $dbPool->get('core')->prefix . 'comments_list` (`comments_list_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'comments_comment_ibfk_2` FOREIGN KEY (`comments_comment_ref`) REFERENCES `' . $dbPool->get('core')->prefix . 'comments_comment` (`comments_comment_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'comments_comment_ibfk_3` FOREIGN KEY (`comments_comment_created_by`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();
                break;
        }
    }
}
