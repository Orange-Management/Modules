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
    protected const MODULE_NAME = 'Navigation';
    protected const URI_LOAD = '';

    use \Modules\tests\ModuleTestTrait;

    /**
     * Test if navigation model works correct
     *
     * @group final
     */
    public function testNavigationElements() : void
    {
        $request = new Request(new Http('http://127.0.0.1/en/backend'));
        $request->createRequestHashs(1);

        $account       = AccountMapper::getWithPermissions(1);
        $nav           = Navigation::getInstance($request, $account, $GLOBALS['dbpool'], 1, 'Backend')->getNav();
        $moduleManager = new ModuleManager($this->app, __DIR__ . '/../../../../Modules');
        $modules       = $moduleManager->getInstalledModules(false);

        self::assertGreaterThan(0, \count($nav));
    }
}
