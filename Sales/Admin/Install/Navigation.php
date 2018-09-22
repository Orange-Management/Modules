<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Sales\Admin\Install
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Sales\Admin\Install;

use phpOMS\DataStorage\Database\DatabasePool;

/**
 * Navigation class.
 *
 * @package    Modules\Sales\Admin\Install
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Navigation
{
    /**
     * Install navigation providing
     *
     * @param string       $path   Path to some file
     * @param DatabasePool $dbPool Database pool for database interaction
     *
     * @return void
     *
     * @since  1.0.0
     */
    public static function install(string $path = null, DatabasePool $dbPool = null) : void
    {
        $navFile = \file_get_contents(__DIR__ . '/Navigation.install.json');

        if ($navFile === false) {
            throw new \Exception();
        }

        $navData = \json_decode($navFile, true);

        if ($navData === false) {
            throw new \Exception();
        }

        $class = '\\Modules\\Navigation\\Admin\\Installer';
        /** @var $class \Modules\Navigation\Admin\Installer */
        $class::installExternal($dbPool, $navData);
    }
}
