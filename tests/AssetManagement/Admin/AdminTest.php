<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\AssetManagement\Admin;

use Modules\AssetManagement\Admin\Installer;
use Modules\AssetManagement\Admin\Uninstall;
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
        $app = new class extends ApplicationAbstract {};
        $app->dbPool = $GLOBALS['dbpool'];

        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');
        $moduleManager->install('AssetManagement');

        $moduleManager->deactivate('AssetManagement');
        self::assertFalse($moduleManager->isActive('AssetManagement'));

        $moduleManager->activate('AssetManagement');
        self::assertTrue($moduleManager->isActive('AssetManagement'));
    }
}
