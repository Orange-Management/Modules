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

namespace Modules\tests\AccountsReceivable\Admin;

use Modules\AccountsReceivable\Admin\Installer;
use Modules\AccountsReceivable\Admin\Uninstall;
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
        $moduleManager->install('AccountsReceivable');

        $moduleManager->deactivate('AccountsReceivable');
        self::assertFalse($moduleManager->isActive('AccountsReceivable'));

        $moduleManager->activate('AccountsReceivable');
        self::assertTrue($moduleManager->isActive('AccountsReceivable'));
    }
}
