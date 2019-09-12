<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Dashboard\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Dashboard\Admin;

use Modules\Dashboard\Models\DashboardBoard;
use Modules\Dashboard\Models\DashboardBoardMapper;
use phpOMS\DataStorage\Database\DatabasePool;

use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Installer class.
 *
 * @package Modules\Dashboard\Admin
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Installer extends InstallerAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function install(DatabasePool $dbPool, InfoManager $info) : void
    {
        parent::install($dbPool, $info);

        $board = new DashboardBoard();
        DashboardBoardMapper::create($board);
    }
}
