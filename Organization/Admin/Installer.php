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

use Model\CoreSettings;

use Modules\Organization\Controller\ApiController;
use Modules\Organization\Models\SettingsEnum;
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
class Installer extends InstallerAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function install(DatabasePool $dbPool, ModuleInfo $info) : void
    {
        parent::install($dbPool, $info);

        self::installDefaultUnit();
        self::installSettings($dbPool);
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

    /**
     * Install settings
     *
     * @param DatabasePool $dbPool Database pool
     *
     * @return void
     *
     * @since 1.0.0
     */
    private static function installSettings(DatabasePool $dbPool) : void
    {
        $settings = new CoreSettings($dbPool->get('insert'));
        $settings->create(['name' => SettingsEnum::GROUP_GENERATE_AUTOMATICALLY_UNIT, 'content' => '1', 'module' => ApiController::MODULE_NAME]);
        $settings->create(['name' => SettingsEnum::GROUP_GENERATE_AUTOMATICALLY_DEPARTMENT, 'content' => '1', 'module' => ApiController::MODULE_NAME]);
        $settings->create(['name' => SettingsEnum::GROUP_GENERATE_AUTOMATICALLY_POSITION, 'content' => '1', 'module' => ApiController::MODULE_NAME]);
    }
}
