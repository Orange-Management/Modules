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
namespace Modules\Navigation\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\Pool;
use phpOMS\Module\InstallerAbstract;

/**
 * Navigation class.
 *
 * @category   Modules
 * @package    Modules\Navigation
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
    public static function install(Pool $dbPool, array $info)
    {
        parent::install($dbPool, $info);

        switch ($dbPool->get('core')->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'nav` (
                            `nav_id` int(11) NOT NULL,
                            `nav_pid` varchar(40) NOT NULL,
                            `nav_name` varchar(40) NOT NULL,
                            `nav_type` tinyint(1) NOT NULL,
                            `nav_subtype` tinyint(1) NOT NULL,
                            `nav_icon` varchar(40) DEFAULT NULL,
                            `nav_uri` varchar(255) DEFAULT NULL,
                            `nav_target` varchar(10) DEFAULT NULL,
                            `nav_from` varchar(255) DEFAULT NULL,
                            `nav_order` smallint(3) DEFAULT NULL,
                            `nav_parent` int(11) DEFAULT NULL,
                            `nav_permission` int(11) DEFAULT NULL,
                            PRIMARY KEY (`nav_id`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();
                break;
        }
    }

    /**
     * Install data from providing modules.
     *
     * @param Pool  $dbPool Database pool
     * @param array $data   Module info
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function installExternal(Pool $dbPool, array $data)
    {
        try {
            $dbPool->get('core')->con->query('select 1 from `' . $dbPool->get('core')->prefix . 'nav`');
        } catch (\Exception $e) {
            return;
        }

        foreach ($data as $link) {
            self::installLink($dbPool, $link, $link['parent']);
        }
    }

    /**
     * Install navigation element.
     *
     * @param Pool  $dbPool Database instance
     * @param array $data   Link info
     * @param \int  $parent Parent element (default is 0 for none)
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private static function installLink($dbPool, $data, $parent = 0)
    {
        $sth = $dbPool->get('core')->con->prepare(
            'INSERT INTO `' . $dbPool->get('core')->prefix . 'nav` (`nav_id`, `nav_pid`, `nav_name`, `nav_type`, `nav_subtype`, `nav_icon`, `nav_uri`, `nav_target`, `nav_from`, `nav_order`, `nav_parent`, `nav_permission`) VALUES
                        (:id, :pid, :name, :type, :subtype, :icon, :uri, :target, :from, :order, :parent, :perm);'
        );

        $sth->bindValue(':id', $data['id'] ?? 0, \PDO::PARAM_INT);
        $sth->bindValue(':pid', $data['pid'] ?? '', \PDO::PARAM_STR);
        $sth->bindValue(':name', $data['name'] ?? '', \PDO::PARAM_STR);
        $sth->bindValue(':type', $data['type'] ?? 1, \PDO::PARAM_INT);
        $sth->bindValue(':subtype', $data['subtype'] ?? 2, \PDO::PARAM_INT);
        $sth->bindValue(':icon', $data['icon'] ?? null, \PDO::PARAM_STR);
        $sth->bindValue(':uri', $data['uri'] ?? null, \PDO::PARAM_STR);
        $sth->bindValue(':target', $data['target'] ?? "self", \PDO::PARAM_STR);
        $sth->bindValue(':from', $data['from'] ?? 0, \PDO::PARAM_INT);
        $sth->bindValue(':order', $data['order'] ?? 1, \PDO::PARAM_INT);
        $sth->bindValue(':parent', $parent, \PDO::PARAM_INT);
        $sth->bindValue(':perm', $data['permission'] ?? 0, \PDO::PARAM_INT);

        $sth->execute();

        $lastInsertID = $dbPool->get('core')->con->lastInsertId();

        foreach ($data['children'] as $link) {
            $parent = ($link['parent'] == null ? $lastInsertID : $link['parent']);
            self::installLink($dbPool, $link, $parent);
        }
    }
}
