<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Exchange
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Admin;

use Modules\Exchange\Models\InterfaceManager;
use Modules\Exchange\Models\InterfaceManagerMapper;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InstallerAbstract;

use phpOMS\Module\ModuleInfo;
use phpOMS\System\File\Local\Directory;

/**
 * Installer class.
 *
 * @package Modules\Exchange
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class Installer extends InstallerAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function install(DatabasePool $dbPool, ModuleInfo $info) : void
    {
        parent::install($dbPool, $info);

        $interfaces = Directory::list(__DIR__ . '/../Interfaces', '.*interface\.json');

        foreach ($interfaces as $interface) {
            $exchange = new InterfaceManager(__DIR__ . '/../Interfaces/' . $interface);
            $exchange->load();

            InterfaceManagerMapper::create($exchange);
        }
    }
}
