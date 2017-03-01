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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\ItemManagement\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Item Reference install class.
 *
 * @category   Modules
 * @package    Modules\ItemReference
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'itemreference_item` (
                            `itemreference_item_id` int(11) NOT NULL AUTO_INCREMENT,
                            `itemreference_item_no` varchar(30) DEFAULT NULL,
                            `itemreference_item_articlegroup` int(11) DEFAULT NULL,
                            `itemreference_item_salesgroup` int(11) DEFAULT NULL,
                            `itemreference_item_productgroup` int(11) DEFAULT NULL,
                            `itemreference_item_segment` int(11) DEFAULT NULL,
                            `itemreference_item_successor` int(11) DEFAULT NULL,
                            PRIMARY KEY (`itemreference_item_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'itemreference_media` (
                            `itemreference_media_id` int(11) NOT NULL AUTO_INCREMENT,
                            `itemreference_media_item` int(11) DEFAULT NULL,
                            `itemreference_media_media` int(11) DEFAULT NULL,
                            PRIMARY KEY (`itemreference_partslist_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'itemreference_docs` (
                            `itemreference_docs_id` int(11) NOT NULL AUTO_INCREMENT,
                            `itemreference_docs_item` int(11) DEFAULT NULL,
                            `itemreference_docs_media` int(11) DEFAULT NULL,
                            PRIMARY KEY (`itemreference_partslist_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'itemreference_localization` (
                            `itemreference_localization_id` int(11) NOT NULL AUTO_INCREMENT,
                            `itemreference_localization_language` varchar(30) DEFAULT NULL,
                            `itemreference_localization_name1` varchar(30) DEFAULT NULL,
                            `itemreference_localization_name2` varchar(30) DEFAULT NULL,
                            `itemreference_localization_name3` varchar(30) DEFAULT NULL,
                            `itemreference_localization_desc` text DEFAULT NULL,
                            `itemreference_localization_item` text DEFAULT NULL,
                            PRIMARY KEY (`itemreference_localization_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'itemreference_partslist` (
                            `itemreference_partslist_id` int(11) NOT NULL AUTO_INCREMENT,
                            `itemreference_partslist_item` int(11) DEFAULT NULL,
                            `itemreference_partslist_ref` int(11) DEFAULT NULL,
                            `itemreference_partslist_pos` int(11) DEFAULT NULL,
                            `itemreference_partslist_amount` int(11) DEFAULT NULL,
                            PRIMARY KEY (`itemreference_partslist_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'itemreference_purchase` (
                            `itemreference_purchase_id` int(11) NOT NULL AUTO_INCREMENT,
                            `itemreference_purchase_item` int(11) DEFAULT NULL,
                            `itemreference_purchase_supplier` int(11) DEFAULT NULL,
                            `itemreference_purchase_order_no` varchar(50) DEFAULT NULL,
                            `itemreference_purchase_amount` int(11) DEFAULT NULL,
                            `itemreference_purchase_leadtime` int(11) DEFAULT NULL,
                            PRIMARY KEY (`itemreference_partslist_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'itemreference_purchase_price` (
                            `itemreference_purchase_price_id` int(11) NOT NULL AUTO_INCREMENT,
                            `itemreference_purchase_price_supplier` int(11) DEFAULT NULL,
                            `itemreference_purchase_price_amount` varchar(50) DEFAULT NULL,
                            `itemreference_purchase_price_price` int(11) DEFAULT NULL,
                            `itemreference_purchase_price_bonus` int(11) DEFAULT NULL,
                            `itemreference_purchase_price_discountp` int(11) DEFAULT NULL,
                            `itemreference_purchase_price_discount` int(11) DEFAULT NULL,
                            `itemreference_purchase_price_weight` int(11) DEFAULT NULL,
                            PRIMARY KEY (`itemreference_purchase_price_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

				$dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'itemreference_disposal` (
                            `itemreference_disposal_id` int(11) NOT NULL AUTO_INCREMENT,
                            `itemreference_disposal_item` int(11) DEFAULT NULL,
                            `itemreference_disposal_type` int(11) DEFAULT NULL,
                            `itemreference_disposal_amount` int(11) DEFAULT NULL,
                            `itemreference_disposal_cost` int(11) DEFAULT NULL,
                            PRIMARY KEY (`itemreference_disposal_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                break;
        }
    }
}
