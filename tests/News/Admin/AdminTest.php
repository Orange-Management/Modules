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

namespace Modules\tests\News\Admin;

use phpOMS\ApplicationAbstract;
use phpOMS\Dispatcher\Dispatcher;
use phpOMS\Message\Http\Request;
use phpOMS\Module\ModuleManager;
use phpOMS\Uri\Http;
use phpOMS\Utils\TestUtils;

class AdminTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @group admin
     * @slowThreshold 5000
     */
    public function testModuleIntegration() : void
    {
        $app         = new class extends ApplicationAbstract { protected $appName = 'Api'; };
        $app->dbPool = $GLOBALS['dbpool'];

        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');
        $moduleManager->install('News');

        self::assertTrue($moduleManager->deactivate('News'));
        self::assertFalse($moduleManager->isActive('News'));

        self::assertTrue($moduleManager->activate('News'));
        self::assertTrue($moduleManager->isActive('News'));
    }

    public function testRequestLoads() : void
    {
        $app             = new class extends ApplicationAbstract { protected $appName = 'Api'; };
        $app->dbPool     = $GLOBALS['dbpool'];
        $app->dispatcher = new Dispatcher($app);

        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');

        $request = new Request(new Http('http://127.0.0.1/en/backend/news'));
        $request->createRequestHashs(1);

        $loaded = $moduleManager->getUriLoad($request);

        $found = false;
        foreach ($loaded[4] as $module) {
            if ($module['module_load_file'] === 'News') {
                $found = true;
                break;
            }
        }

        self::assertTrue($found);
        self::assertGreaterThan(0, \count($moduleManager->getLanguageFiles($request)));
        self::assertTrue(\in_array('News', $moduleManager->getRoutedModules($request)));

        $moduleManager->initRequestModules($request);
        self::assertTrue(isset(TestUtils::getMember($moduleManager, 'running')['News']));
    }
}
