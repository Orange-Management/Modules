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

namespace Modules\tests\Home\Admin;

use Modules\Home\Admin\Installer;
use Modules\Home\Admin\Uninstall;
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
        $app         = new class extends ApplicationAbstract {};
        $app->dbPool = $GLOBALS['dbpool'];

        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../Modules');
        $moduleManager->install('Home');

        $moduleManager->deactivate('Home');
        self::assertFalse($moduleManager->isActive('Home'));

        $moduleManager->activate('Home');
        self::assertTrue($moduleManager->isActive('Home'));
    }
}
