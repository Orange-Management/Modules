<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Shop\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Shop\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;
use phpOMS\System\File\Local\Directory;

/**
 * Installer class.
 *
 * @package    Modules\Shop\Admin
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
        if (\file_exists(__DIR__ . '/../../../Web/Shop')) {
            Directory::delete(__DIR__ . '/../../../Web/Shop');
        }

        Directory::copy(__DIR__ . '/Install/Shop', __DIR__ . '/../../../Web/Shop');

        parent::install($dbPool, $info);
    }
}
