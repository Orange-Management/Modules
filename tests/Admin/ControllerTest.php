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

namespace Modules\tests\Admin;

require_once __DIR__ . '/../Autoloader.php';

use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Localization\Localization;
use phpOMS\Message\Http\Request;
use phpOMS\Message\Http\Response;
use phpOMS\Module\ModuleFactory;
use phpOMS\Router\Router;
use phpOMS\Uri\Http;
use phpOMS\Account\Account;
use phpOMS\Account\AccountManager;
use phpOMS\DataStorage\Session\HttpSession;
use phpOMS\Utils\TestUtils;
use Modules\Admin\Models\AccountPermission;
use phpOMS\Account\PermissionType;

use phpOMS\Account\GroupStatus;
use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;

use Model\CoreSettings;

class ControllerTest extends \PHPUnit\Framework\TestCase
{
    protected $app    = null;
    protected $module = null;

    protected function setUp()
    {
        $this->app = new class extends ApplicationAbstract
        {
        };

        $this->app->dbPool         = $GLOBALS['dbpool'];
        $this->app->orgId          = 1;
        $this->app->appName        = 'backend';
        $this->app->accountManager = new AccountManager($GLOBALS['session']);
        $this->app->appSettings    = new CoreSettings($this->app->dbPool->get());

        $account = new Account();
        TestUtils::setMember($account, 'id', 1);

        $permission = new AccountPermission();
        $permission->setUnit(1);
        $permission->setApp('backend');
        $permission->setPermission(
            PermissionType::READ
            | PermissionType::CREATE
            | PermissionType::MODIFY
            | PermissionType::DELETE
            | PermissionType::PERMISSION
        );

        $account->addPermission($permission);

        $this->app->accountManager->add($account);
        $this->app->router = new Router();

        $this->module = ModuleFactory::getInstance('Admin', $this->app);

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    public function testApiSettingsGet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1000000019');

        $this->module->apiSettingsGet($request, $response);

        self::assertEquals('DE', $response->get(''));
    }

    public function testApiSettingsSet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('settings', json_encode(['1000000019' => 'US']));

        $this->module->apiSettingsSet($request, $response);

        $request->setData('id', '1000000019');
        $this->module->apiSettingsGet($request, $response);

        self::assertEquals('US', $response->get(''));
    }

    public function testApiGroupGet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '3');

        $this->module->apiGroupGet($request, $response);

        self::assertEquals('admin', $response->get('')['name']);
        self::assertGreaterThan(0, $response->get('')['id']);
    }

    public function testApiGroupSet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '3');
        $request->setData('name', 'root');

        $this->module->apiGroupSet($request, $response);
        $this->module->apiGroupGet($request, $response);

        self::assertEquals('root', $response->get('')['name']);

        $request->setData('name', 'admin');
        $this->module->apiGroupSet($request, $response);
    }

    public function testApiGroupCreateDelete()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('name', 'test');
        $request->setData('status', GroupStatus::INACTIVE);
        $request->setData('description', 'test description');

        $this->module->apiGroupCreate($request, $response);

        self::assertEquals('test', $response->get('')['name']);
        self::assertGreaterThan(0, $response->get('')['id']);

        // test delete
        $request->setData('id', $response->get('')['id']);
        $this->module->apiGroupDelete($request, $response);

        self::assertGreaterThan(0, $response->get(''));
    }

    public function testApiAccountGet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiAccountGet($request, $response);

        self::assertEquals('admin', $response->get('')['login']);
        self::assertGreaterThan(0, $response->get('')['id']);
    }

    public function testApiAccountCreate()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('login', 'guest');
        $request->setData('name1', 'Guest');
        $request->setData('email', 'test@email.com');
        $request->setData('type', AccountType::USER);
        $request->setData('status', AccountStatus::INACTIVE);

        $this->module->apiAccountCreate($request, $response);

        self::assertEquals('guest', $response->get('')['login']);
        self::assertGreaterThan(0, $response->get('')['id']);

        // test delete
        $request->setData('id', $response->get('')['id']);
        $this->module->apiAccountDelete($request, $response);

        self::assertGreaterThan(0, $response->get(''));
    }

    public function testApiAccountUpdate()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('email', 'oms@orange-management.de');

        $this->module->apiAccountUpdate($request, $response);
        $this->module->apiAccountGet($request, $response);

        self::assertEquals('oms@orange-management.de', $response->get('')['email']);
        self::assertGreaterThan(0, $response->get('')['id']);
    }
}
