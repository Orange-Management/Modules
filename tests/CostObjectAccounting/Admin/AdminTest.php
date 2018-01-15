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

namespace Modules\tests\CostObjectAccounting\Admin;

use Modules\CostObjectAccounting\Admin\Installer;
use Modules\CostObjectAccounting\Admin\Uninstall;
use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\ModuleManager;

require_once __DIR__ . '/../../Autoloader.php';


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

        $moduleManager = new ModuleManager($app, __DIR__ . '/../../../../../Modules');
        $moduleManager->install('CostObjectAccounting');

        $moduleManager->deactivate('CostObjectAccounting');
        self::assertFalse($moduleManager->isActive('CostObjectAccounting'));

        $moduleManager->activate('CostObjectAccounting');
        self::assertTrue($moduleManager->isActive('CostObjectAccounting'));
    }
}
