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
namespace Modules\Marketing\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Marketing install class.
 *
 * @category   Modules
 * @package    Modules\Marketing
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

        switch ($dbPool->get()->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get()->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get()->prefix . 'marketing_promotion` (
                            `marketing_promotion_id` int(11) NOT NULL AUTO_INCREMENT,
                            `marketing_promotion_name`  varchar(30) NOT NULL,
                            `marketing_promotion_description` text DEFAULT NULL,
                            `marketing_promotion_start` datetime DEFAULT NULL,
                            `marketing_promotion_end` datetime DEFAULT NULL,
                            `marketing_promotion_type` tinyint(1) DEFAULT NULL,
                            PRIMARY KEY (`marketing_promotion_id`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();
                break;
        }
    }
}
