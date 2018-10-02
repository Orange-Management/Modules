<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\CostObjectAccounting\Admin;

use Modules\CostObjectAccounting\Admin\Installer;
use Modules\CostObjectAccounting\Admin\Uninstall;
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
        $app         = new class extends ApplicationAbstract { protected $appName = 'Api'; };
        $app->dbPool = $GLOBALS['dbpool'];

        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');
        $moduleManager->install('CostObjectAccounting');

        self::assertTrue($moduleManager->deactivate('CostObjectAccounting'));
        self::assertFalse($moduleManager->isActive('CostObjectAccounting'));

        self::assertTrue($moduleManager->activate('CostObjectAccounting'));
        self::assertTrue($moduleManager->isActive('CostObjectAccounting'));
    }
}
