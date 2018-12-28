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

namespace Modules\tests\Navigation\Admin;

use Modules\Admin\Models\AccountMapper;
use Modules\Navigation\Models\Navigation;
use phpOMS\ApplicationAbstract;
use phpOMS\Message\Http\Request;
use phpOMS\Module\ModuleManager;
use phpOMS\Uri\Http;

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
        $moduleManager->install('Navigation');

        self::assertTrue($moduleManager->deactivate('Navigation'));
        self::assertFalse($moduleManager->isActive('Navigation'));

        self::assertTrue($moduleManager->activate('Navigation'));
        self::assertTrue($moduleManager->isActive('Navigation'));
    }

    /**
     * Test if navigation model works correct
     *
     * @group final
     */
    public function testNavigationElements() : void
    {
        $app         = new class extends ApplicationAbstract { protected $appName = 'Backend'; };
        $app->dbPool = $GLOBALS['dbpool'];

        $request = new Request(new Http('http://127.0.0.1/en/backend'));
        $request->createRequestHashs(1);

        $account       = AccountMapper::getWithPermissions(1);
        $nav           = Navigation::getInstance($request, $account, $GLOBALS['dbpool'], 1, 'Backend')->getNav();
        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');
        $modules       = $moduleManager->getInstalledModules(false);

        self::assertGreaterThan(0, count($nav));
    }
}
