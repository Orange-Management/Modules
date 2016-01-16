<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */

namespace Tests\PHPUnit\Modules\Business\Admin;

use Modules\Business\Admin\Installer;
use Modules\Business\Admin\Uninstall;
use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\Pool;
use phpOMS\Module\ModuleManager;

require_once __DIR__ . '/../../../../../phpOMS/Autoloader.php';
require_once __DIR__ . '/../../../../../config.php';

class AdminTest extends \PHPUnit_Framework_TestCase
{
    protected $dbPool = null;

    protected function setUp()
    {
        $this->dbPool = new Pool();
        /** @var array $CONFIG */
        $this->dbPool->create('core', $GLOBALS['CONFIG']['db']['core']['masters'][0]);
    }

    /**
     * @group admin
     */
    public function testAdmin()
    {
        $info = json_decode(file_get_contents(__DIR__ . '/../../../../../Modules/Business/info.json'), true);
        Installer::install($this->dbPool, $info);

        // todo: test is installed

        Uninstall::uninstall($this->dbPool, $info);
    }
    
    /**
     * @group admin
     */
    public function testModuleIntegration() 
    {
        $app = new class extends ApplicationAbstract {};
        $app->dbPool = $this->dbPool;

        $moduleManager = new ModuleManager($app);
        $moduleManager->install('Accounting');
    }
}
