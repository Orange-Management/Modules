<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Shop\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Shop\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\ModuleInfo;
use phpOMS\Module\InstallerAbstract;
use phpOMS\System\File\Local\Directory;

/**
 * Installer class.
 *
 * @package Modules\Shop\Admin
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Installer extends InstallerAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function install(DatabasePool $dbPool, ModuleInfo $info) : void
    {
        if (\file_exists(__DIR__ . '/../../../Web/Shop')) {
            Directory::delete(__DIR__ . '/../../../Web/Shop');
        }

        Directory::copy(__DIR__ . '/Install/Shop', __DIR__ . '/../../../Web/Shop');

        parent::install($dbPool, $info);
    }
}
