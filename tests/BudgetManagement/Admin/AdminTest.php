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

namespace Modules\tests\BudgetManagement\Admin;

use Modules\BudgetManagement\Admin\Installer;
use Modules\BudgetManagement\Admin\Uninstall;
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
        $moduleManager->install('BudgetManagement');

        self::assertTrue($moduleManager->deactivate('BudgetManagement'));
        self::assertFalse($moduleManager->isActive('BudgetManagement'));

        self::assertTrue($moduleManager->activate('BudgetManagement'));
        self::assertTrue($moduleManager->isActive('BudgetManagement'));
    }
}
