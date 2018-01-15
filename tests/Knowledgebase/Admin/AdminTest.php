<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\Knowledgebase\Admin;

use Modules\Knowledgebase\Admin\Installer;
use Modules\Knowledgebase\Admin\Uninstall;
use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\ModuleManager;
use phpOMS\Message\Http\Request;
use phpOMS\Uri\Http;
use phpOMS\Utils\TestUtils;
use phpOMS\Dispatcher\Dispatcher;

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
        $moduleManager->install('Knowledgebase');

        $moduleManager->deactivate('Knowledgebase');
        self::assertFalse($moduleManager->isActive('Knowledgebase'));

        $moduleManager->activate('Knowledgebase');
        self::assertTrue($moduleManager->isActive('Knowledgebase'));
    }

    public function testRequestLoads()
    {
        $app = new class extends ApplicationAbstract {};
        $app->dbPool = $GLOBALS['dbpool'];
        $app->dispatcher = new Dispatcher($app);
    
        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');

        $request = new Request(new Http('http://127.0.0.1/en/backend/wiki'));
        $request->createRequestHashs(1);

        $loaded = $moduleManager->getUriLoad($request);
        
        $found = false;
        foreach ($loaded[4] as $module) {
            if ($module['module_load_file'] === 'Knowledgebase') {
                $found = true;
                break;
            }
        }

        self::assertTrue($found);
        self::assertGreaterThan(0, count($moduleManager->getLanguageFiles($request)));
        self::assertTrue(in_array('Knowledgebase', $moduleManager->getRoutedModules($request)));

        $moduleManager->initRequestModules($request);
        self::assertTrue(isset(TestUtils::getMember($moduleManager, 'running')['Knowledgebase']));
    }
}
