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

namespace Modules\tests\Admin\Admin;

use Modules\Admin\Admin\Installer;
use Modules\Admin\Admin\Uninstall;
use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\ModuleManager;
use phpOMS\Message\Http\Request;
use phpOMS\Uri\Http;
use phpOMS\Utils\TestUtils;
use phpOMS\Dispatcher\Dispatcher;

class AdminTest extends \PHPUnit\Framework\TestCase
{
    public function testModuleIntegration()
    {
        $app         = new class extends ApplicationAbstract { protected $appName = 'Api'; };
        $app->dbPool = $GLOBALS['dbpool'];

        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');

        self::assertTrue($moduleManager->deactivate('Admin'));
        self::assertFalse($moduleManager->isActive('Admin'));

        self::assertTrue($moduleManager->activate('Admin'));
        self::assertTrue($moduleManager->isActive('Admin'));
    }

    public function testRequestLoads()
    {
        $app             = new class extends ApplicationAbstract { protected $appName = 'Api'; };
        $app->dbPool     = $GLOBALS['dbpool'];
        $app->dispatcher = new Dispatcher($app);

        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');

        $request = new Request(new Http('http://127.0.0.1/en/backend/admin'));
        $request->createRequestHashs(1);

        $loaded = $moduleManager->getUriLoad($request);

        $found = false;
        foreach ($loaded[4] as $module) {
            if ($module['module_load_file'] === 'Admin') {
                $found = true;
                break;
            }
        }

        self::assertTrue($found);
        self::assertGreaterThan(0, count($moduleManager->getLanguageFiles($request)));
        self::assertTrue(\in_array('Admin', $moduleManager->getRoutedModules($request)));

        $moduleManager->initRequestModules($request);
        self::assertTrue(isset(TestUtils::getMember($moduleManager, 'running')['Admin']));
    }
}
