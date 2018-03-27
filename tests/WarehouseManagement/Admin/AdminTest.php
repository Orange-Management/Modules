<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\WarehouseManagement\Admin;

use Modules\WarehouseManagement\Admin\Installer;
use Modules\WarehouseManagement\Admin\Uninstall;
use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\ModuleManager;

class AdminTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @group admin
     * @slowThreshold 5000
     */
    public function testModuleIntegration()
    {
        $app         = new class extends ApplicationAbstract {};
        $app->dbPool = $GLOBALS['dbpool'];

        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');
        $moduleManager->install('WarehouseManagement');

        $moduleManager->deactivate('WarehouseManagement');
        self::assertFalse($moduleManager->isActive('WarehouseManagement'));

        $moduleManager->activate('WarehouseManagement');
        self::assertTrue($moduleManager->isActive('WarehouseManagement'));
    }
}
