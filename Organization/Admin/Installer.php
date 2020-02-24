<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Organization\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Organization\Admin;

use Modules\Organization\Models\Unit;
use Modules\Organization\Models\UnitMapper;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InstallerAbstract;
use phpOMS\Module\ModuleInfo;

/**
 * Installer class.
 *
 * @package Modules\Organization\Admin
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

        self::installDefaultUnit();
    }

    /**
     * Install default unit
     *
     * @return void
     *
     * @since 1.0.0
     */
    private static function installDefaultUnit() : void
    {
        $unit = new Unit();
        $unit->setName('Orange Management');

        UnitMapper::create($unit);
    }
}
