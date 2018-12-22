<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Knowledgebase\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Tasks install class.
 *
 * @package    Modules\Knowledgebase\Admin
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'wiki_category` (
                            `wiki_category_id` int(11) NOT NULL AUTO_INCREMENT,
                            `wiki_category_name` varchar(255) NOT NULL,
                            `wiki_category_parent` int(11) DEFAULT NULL,
                            PRIMARY KEY (`wiki_category_id`),
                            KEY `wiki_category_parent` (`wiki_category_parent`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'wiki_category`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'wiki_category_ibfk_1` FOREIGN KEY (`wiki_category_parent`) REFERENCES `' . $dbPool->get()->prefix . 'wiki_category` (`wiki_category_id`)'
                )->execute();

                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'wiki_article` (
                            `wiki_article_id` int(11) NOT NULL AUTO_INCREMENT,
                            `wiki_article_status` int(11) NOT NULL,
                            `wiki_article_title` varchar(255) NOT NULL,
                            `wiki_article_language` varchar(3) NOT NULL,
                            `wiki_article_doc` text NOT NULL,
                            `wiki_article_created_by` int(11) NOT NULL,
                            `wiki_article_created_at` datetime NOT NULL,
                            `wiki_article_category` int(11) DEFAULT NULL,
                            PRIMARY KEY (`wiki_article_id`),
                            KEY `wiki_article_created_by` (`wiki_article_created_by`),
                            KEY `wiki_article_category` (`wiki_article_category`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get()->con->prepare(
                    'ALTER TABLE `' . $dbPool->get()->prefix . 'wiki_article`
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'wiki_article_ibfk_1` FOREIGN KEY (`wiki_article_created_by`) REFERENCES `' . $dbPool->get()->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get()->prefix . 'wiki_article_ibfk_2` FOREIGN KEY (`wiki_article_category`) REFERENCES `' . $dbPool->get()->prefix . 'wiki_category` (`wiki_category_id`);'
                )->execute();
                break;
        }
    }
}
