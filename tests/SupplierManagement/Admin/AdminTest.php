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

namespace Modules\tests\SupplierManagement\Admin;

use Modules\SupplierManagement\Admin\Installer;
use Modules\SupplierManagement\Admin\Uninstall;
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
        $moduleManager->install('SupplierManagement');

        $moduleManager->deactivate('SupplierManagement');
        self::assertFalse($moduleManager->isActive('SupplierManagement'));

        $moduleManager->activate('SupplierManagement');
        self::assertTrue($moduleManager->isActive('SupplierManagement'));
    }
}
