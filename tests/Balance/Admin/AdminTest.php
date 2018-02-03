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

namespace Modules\tests\Balance\Admin;

use Modules\Balance\Admin\Installer;
use Modules\Balance\Admin\Uninstall;
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
        $moduleManager->install('Balance');

        $moduleManager->deactivate('Balance');
        self::assertFalse($moduleManager->isActive('Balance'));

        $moduleManager->activate('Balance');
        self::assertTrue($moduleManager->isActive('Balance'));
    }
}
