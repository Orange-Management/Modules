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

namespace Modules\tests\Sales\Admin;

use Modules\Sales\Admin\Installer;
use Modules\Sales\Admin\Uninstall;
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
        $moduleManager->install('Sales');

        self::assertTrue($moduleManager->deactivate('Sales'));
        self::assertFalse($moduleManager->isActive('Sales'));

        self::assertTrue($moduleManager->activate('Sales'));
        self::assertTrue($moduleManager->isActive('Sales'));
    }
}
