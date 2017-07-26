<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\News\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * News install class.
 *
 * @category   Modules
 * @package    Modules\News
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
        parent::install(__DIR__ . '/..', $dbPool, $info);

        switch ($dbPool->get('core')->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'news` (
                            `news_id` int(11) NOT NULL AUTO_INCREMENT,
                            `news_title` varchar(250) NOT NULL,
                            `news_featured` tinyint(1) DEFAULT NULL,
                            `news_content` text NOT NULL,
                            `news_plain` text NOT NULL,
                            `news_type` tinyint(2) NOT NULL,
                            `news_status` tinyint(1) NOT NULL,
                            `news_lang` varchar(2) NOT NULL,
                            `news_publish` datetime NOT NULL,
                            `news_created_at` datetime NOT NULL,
                            `news_created_by` int(11) NOT NULL,
                            PRIMARY KEY (`news_id`),
                            KEY `news_created_by` (`news_created_by`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'news`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'news_ibfk_1` FOREIGN KEY (`news_created_by`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'news_tag` (
                            `news_tag_id` int(11) NOT NULL AUTO_INCREMENT,
                            `news_tag_news` int(11) NOT NULL,
                            `news_tag_tag` varchar(20) NOT NULL,
                            PRIMARY KEY (`news_tag_id`),
                            KEY `news_tag_news` (`news_tag_news`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'news_tag`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'news_tag_ibfk_1` FOREIGN KEY (`news_tag_news`) REFERENCES `' . $dbPool->get('core')->prefix . 'news` (`news_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'news_group` (
                            `news_group_id` int(11) NOT NULL AUTO_INCREMENT,
                            `news_group_news` int(11) NOT NULL,
                            `news_group_group` int(11) NOT NULL,
                            PRIMARY KEY (`news_group_id`),
                            KEY `news_group_news` (`news_group_news`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'news_group`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'news_group_ibfk_1` FOREIGN KEY (`news_group_news`) REFERENCES `' . $dbPool->get('core')->prefix . 'news` (`news_id`);'
                )->execute();
                break;
        }
    }
}
