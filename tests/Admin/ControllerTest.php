<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */

namespace Modules\tests\Admin;

require_once __DIR__ . '/../Autoloader.php';

use Model\CoreSettings;
use Modules\Admin\Models\AccountPermission;
use Modules\Admin\Models\ModuleStatusUpdateType;
use phpOMS\Account\Account;
use phpOMS\Account\AccountManager;
use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;
use phpOMS\Account\GroupStatus;
use phpOMS\Account\PermissionOwner;
use phpOMS\Account\PermissionType;
use phpOMS\ApplicationAbstract;
use phpOMS\Dispatcher\Dispatcher;
use phpOMS\Event\EventManager;

use phpOMS\Message\Http\Request;
use phpOMS\Message\Http\Response;
use phpOMS\Module\ModuleManager;

use phpOMS\Router\Router;
use phpOMS\Uri\Http;

use phpOMS\Utils\TestUtils;

/**
 * @internal
 */
class ControllerTest extends \PHPUnit\Framework\TestCase
{
    protected $app    = null;
    protected $module = null;

    protected function setUp() : void
    {
        $this->app = new class() extends ApplicationAbstract
        {
            protected $appName = 'Api';
        };

        $this->app->dbPool         = $GLOBALS['dbpool'];
        $this->app->orgId          = 1;
        $this->app->appName        = 'Backend';
        $this->app->accountManager = new AccountManager($GLOBALS['session']);
        $this->app->appSettings    = new CoreSettings($this->app->dbPool->get());
        $this->app->moduleManager  = new ModuleManager($this->app, __DIR__ . '/../../../Modules');
        $this->app->dispatcher     = new Dispatcher($this->app);
        $this->app->eventManager   = new EventManager($this->app->dispatcher);
        $this->app->eventManager->importFromFile(__DIR__ . '/../../../Web/Api/Hooks.php');

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

        $this->module = $this->app->moduleManager->get('Admin');

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    public function testApiSettingsGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1000000019');

        $this->module->apiSettingsGet($request, $response);
        self::assertEquals('DE', $response->get('')['response']);
    }

    public function testApiSettingsSet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('settings', \json_encode(['1000000019' => 'US']));
        $this->module->apiSettingsSet($request, $response);

        $request->setData('id', '1000000019');
        $this->module->apiSettingsGet($request, $response);
        self::assertEquals('US', $response->get('')['response']);
    }

    public function testApiGroupGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '3');

        $this->module->apiGroupGet($request, $response);

        self::assertEquals('admin', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiGroupSet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '3');
        $request->setData('name', 'root');

        $this->module->apiGroupUpdate($request, $response);
        $this->module->apiGroupGet($request, $response);

        self::assertEquals('root', $response->get('')['response']->getName());

        $request->setData('name', 'admin');
        $this->module->apiGroupUpdate($request, $response);
    }

    public function testApiGroupFind() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('search', 'admin');

        $this->module->apiGroupFind($request, $response);
        self::assertCount(1, $response->get(''));
        self::assertEquals('admin', $response->get('')[0]->getName());
    }

    public function testApiGroupCreateDelete() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('name', 'test');
        $request->setData('status', GroupStatus::INACTIVE);
        $request->setData('description', 'test description');

        $this->module->apiGroupCreate($request, $response);

        self::assertEquals('test', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());

        // test delete
        $request->setData('id', $response->get('')['response']->getId());
        $this->module->apiGroupDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiGroupCreateInvalid() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('status', 999);
        $request->setData('description', 'test description');

        $this->module->apiGroupCreate($request, $response);
        self::assertEquals('validation', $response->get('group_create')::TYPE);
    }

    public function testApiAccountGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiAccountGet($request, $response);

        self::assertEquals('admin', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiAccountFind() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('search', 'admin');

        $this->module->apiAccountFind($request, $response);
        self::assertCount(1, $response->get(''));
        self::assertEquals('admin', $response->get('')[0]->getName1());
    }

    public function testApiAccountCreate() : void
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

        self::assertEquals('guest', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());

        // test delete
        $request->setData('id', $response->get('')['response']->getId());
        $this->module->apiAccountDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiAccountCreateInvalid() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('status', 999);
        $request->setData('description', 'test description');

        $this->module->apiAccountCreate($request, $response);
        self::assertEquals('validation', $response->get('account_create')::TYPE);
    }

    public function testApiAccountUpdate() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('email', 'oms@orange-management.de');

        $this->module->apiAccountUpdate($request, $response);
        $this->module->apiAccountGet($request, $response);

        self::assertEquals('oms@orange-management.de', $response->get('')['response']->getEmail());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiModuleStatusUpdate() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('module', 'TestModule');

        $request->setData('status', ModuleStatusUpdateType::INSTALL);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('ok', $response->get('')['status']);

        $request->setData('status', ModuleStatusUpdateType::ACTIVATE);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('ok', $response->get('')['status']);

        $request->setData('status', ModuleStatusUpdateType::DEACTIVATE);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('ok', $response->get('')['status']);

        $request->setData('status', ModuleStatusUpdateType::UNINSTALL);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
    }

    public function testApiModuleStatusUpdateEmptyModule() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);

        $request->setData('status', ModuleStatusUpdateType::INSTALL);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertNull($response->get('module_stutus_update'));
    }

    public function testApiModuleStatusUpdateInvalidStatus() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('module', 'TestModule');

        $request->setData('status', 99);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('warning', $response->get('')['status']);
    }

    public function testApiModuleStatusUpdateInvalidModule() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('module', 'invalid');

        $request->setData('status', ModuleStatusUpdateType::INSTALL);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('warning', $response->get('')['status']);
    }

    public function testApiAddGroupPermission() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::GROUP);
        $request->setData('permissionref', 1);

        $this->module->apiAddGroupPermission($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiAddAccountPermission() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::ACCOUNT);
        $request->setData('permissionref', 1);

        $this->module->apiAddAccountPermission($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiAddGroupPermissionInvalidData() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::GROUP);

        $this->module->apiAddGroupPermission($request, $response);
        self::assertEquals('validation', $response->get('permission_create')::TYPE);
    }

    public function testApiAddGroupPermissionInvalidType() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::ACCOUNT);
        $request->setData('permissionref', 1);

        $this->module->apiAddGroupPermission($request, $response);
        self::assertEquals('validation', $response->get('permission_create')::TYPE);
    }

    public function testApiAddAccountPermissionInvalidData() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::ACCOUNT);

        $this->module->apiAddAccountPermission($request, $response);
        self::assertEquals('validation', $response->get('permission_create')::TYPE);
    }

    public function testApiAddAccountPermissionInvalidType() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::GROUP);
        $request->setData('permissionref', 1);

        $this->module->apiAddAccountPermission($request, $response);
        self::assertEquals('validation', $response->get('permission_create')::TYPE);
    }

    public function testApiAddGroupToAccount() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('account', 1);
        $request->setData('igroup-idlist', '1');

        $this->module->apiAddGroupToAccount($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
    }

    public function testApiAddAccountToGroup() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('group', 1);
        $request->setData('iaccount-idlist', '1');

        $this->module->apiAddAccountToGroup($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
    }

    public function testApiReInit() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);

        $routes = include __DIR__ . '/../../../Web/Api/Routes.php';
        $hooks  = include __DIR__ . '/../../../Web/Api/Hooks.php';

        $this->module->apiReInit($request, $response);

        $routes2 = include __DIR__ . '/../../../Web/Api/Routes.php';
        $hooks2  = include __DIR__ . '/../../../Web/Api/Hooks.php';

        self::assertEquals($routes, $routes2);
        self::assertEquals($hooks, $hooks2);
    }

    public function testApiAccountGroupFind() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('search', 'admin');

        $this->module->apiAccountGroupFind($request, $response);
        self::assertCount(2, $response->get(''));
        self::assertEquals('admin', $response->get('')[0]['name'][0] ?? '');
        self::assertEquals('admin', $response->get('')[1]['name'][0] ?? '');
    }
}
