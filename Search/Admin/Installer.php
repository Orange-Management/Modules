<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Search\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Search\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;
use phpOMS\System\File\PathException;
use phpOMS\System\File\PermissionException;
use phpOMS\Utils\Parser\Php\ArrayParser;

/**
 * Installer class.
 *
 * @package    Modules\Search\Admin
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class Installer extends InstallerAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function install(DatabasePool $dbPool, InfoManager $info) : void
    {
        if (\file_exists(__DIR__ . '/../SearchCommands.php')) {
            \unlink(__DIR__ . '/../SearchCommands.php');
        }

        \file_put_contents(__DIR__ . '/../SearchCommands.php', '<?php return [];');
        parent::install($dbPool, $info);
    }

    /**
     * Install data from providing modules.
     *
     * @param DatabasePool $dbPool Database pool
     * @param array        $data   Module info
     *
     * @return void
     *
     * @throws PathException This exception is thrown if the Search install file couldn't be found
     * @throws \Exception    This exception is thrown if the Search install file is invalid json
     *
     * @since  1.0.0
     */
    public static function installExternal(DatabasePool $dbPool, array $data) : void
    {
        if (!\file_exists(__DIR__ . '/../SearchCommands.php')) {
            \file_put_contents(__DIR__ . '/../SearchCommands.php', '<?php return [];');
        }

        if (!\file_exists($data['path'] ?? '')) {
            return;
        }

        if (!\file_exists(__DIR__ . '/../SearchCommands.php')) {
            throw new PathException(__DIR__ . '/../SearchCommands.php');
        }

        if (!\is_writable(__DIR__ . '/../SearchCommands.php')) {
            throw new PermissionException(__DIR__ . '/../SearchCommands.php');
        }

        /** @noinspection PhpIncludeInspection */
        $appRoutes = include __DIR__ . '/../SearchCommands.php';
        /** @noinspection PhpIncludeInspection */
        $moduleRoutes = include $data['path'];

        $appRoutes = \array_merge_recursive($appRoutes, $moduleRoutes);

        \file_put_contents(__DIR__ . '/../SearchCommands.php', '<?php return ' . ArrayParser::serializeArray($appRoutes) . ';', \LOCK_EX);
    }
}
