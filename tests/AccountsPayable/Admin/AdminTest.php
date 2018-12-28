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

namespace Modules\tests\AccountsPayable\Admin;

use phpOMS\ApplicationAbstract;
use phpOMS\Module\ModuleManager;

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
        $moduleManager->install('AccountsPayable');

        self::assertTrue($moduleManager->deactivate('AccountsPayable'));
        self::assertFalse($moduleManager->isActive('AccountsPayable'));

        self::assertTrue($moduleManager->activate('AccountsPayable'));
        self::assertTrue($moduleManager->isActive('AccountsPayable'));
    }
}
