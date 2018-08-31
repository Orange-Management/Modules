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

namespace Modules\tests\ContractLifecycleManagement\Admin;

use Modules\ContractLifecycleManagement\Admin\Installer;
use Modules\ContractLifecycleManagement\Admin\Uninstall;
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
        $moduleManager->install('ContractLifecycleManagement');

        self::assertTrue($moduleManager->deactivate('ContractLifecycleManagement'));
        self::assertFalse($moduleManager->isActive('ContractLifecycleManagement'));

        self::assertTrue($moduleManager->activate('ContractLifecycleManagement'));
        self::assertTrue($moduleManager->isActive('ContractLifecycleManagement'));
    }
}
