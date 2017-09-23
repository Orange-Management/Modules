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
namespace Modules\WarehouseManagement\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\Schema\Builder;
use phpOMS\Module\UninstallAbstract;

/**
 * Navigation class.
 *
 * @category   Modules
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Uninstall extends UninstallAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function uninstall(DatabasePool $dbPool, InfoManager $info)
    {
        parent::uninstall($dbPool, $info);

        $query = new Builder($dbPool->get());

        $query->prefix($dbPool->get()->getPrefix())->drop(
            'warehousing_shipping',
            'warehousing_article_transfer_single',
            'warehousing_article_transfer',
            'warehousing_arrival_transfer',
            'warehousing_article_stock',
            'warehousing_arrival',
            'warehousing_article_disposal',
            'warehousing_article',
            'warehousing_stock_location',
            'warehousing_stock'
        );

        $dbPool->get()->con->prepare($query->toSql())->execute();
    }
}
