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
declare(strict_types = 1);
namespace Modules\Monitoring\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\UninstallAbstract;
use phpOMS\Module\InfoManager;

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
    }
}
