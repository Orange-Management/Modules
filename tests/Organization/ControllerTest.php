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

namespace Modules\tests\Organization;

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

use Modules\Organization\Models\Unit;
use Modules\Organization\Models\Position;
use Modules\Organization\Models\Department;
use Modules\Organization\Models\Status;

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

        $this->app->dbPool = $GLOBALS['dbpool'];
        $this->app->orgId = 1;
        $this->app->appName = 'backend';
        $this->app->accountManager = new AccountManager($GLOBALS['session']);
        $this->app->appSettings = new CoreSettings($this->app->dbPool->get());

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

        $this->module = ModuleFactory::getInstance('Organization', $this->app);

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    public function testApiUnitGet()
    {
        $response = new Response();
        $request = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');
        
        $this->module->apiUnitGet($request, $response);
        
        self::assertEquals('Orange Management', $response->get('')['name']);
        self::assertGreaterThan(0, $response->get('')['id']);
    }

    public function testApiUnitSet()
    {
        $response = new Response();
        $request = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');
        $request->setData('name', 'Orange-Management');

        $this->module->apiUnitSet($request, $response);
        $this->module->apiUnitGet($request, $response);

        self::assertEquals('Orange-Management', $response->get('')['name']);
    }

    public function testApiUnitCreateDelete()
    {
        $response = new Response();
        $request = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('name', 'test');
        $request->setData('status', Status::INACTIVE);
        $request->setData('description', 'test description');

        $this->module->apiUnitCreate($request, $response);

        self::assertEquals('test', $response->get('')['name']);
        self::assertGreaterThan(0, $response->get('')['id']);

        // test delete
        $request->setData('id', $response->get('')['id']);
        $this->module->apiUnitDelete($request, $response);

        self::assertGreaterThan(0, $response->get(''));
    }

    public function testApiDepartmentGet()
    {
        $response = new Response();
        $request = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');
        
        $this->module->apiDepartmentGet($request, $response);
        
        self::assertEquals('Marketing', $response->get('')['name']);
        self::assertGreaterThan(0, $response->get('')['id']);
    }

    public function testApiDepartmentSet()
    {
        $response = new Response();
        $request = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');
        $request->setData('name', 'Production');

        $this->module->apiDepartmentSet($request, $response);
        $this->module->apiDepartmentGet($request, $response);

        self::assertEquals('Production', $response->get('')['name']);
    }

    public function testApiDepartmentCreateDelete()
    {
        $response = new Response();
        $request = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('name', 'test');
        $request->setData('status', Status::INACTIVE);
        $request->setData('description', 'test description');

        $this->module->apiDepartmentCreate($request, $response);

        self::assertEquals('test', $response->get('')['name']);
        self::assertGreaterThan(0, $response->get('')['id']);

        // test delete
        $request->setData('id', $response->get('')['id']);
        $this->module->apiDepartmentDelete($request, $response);

        self::assertGreaterThan(0, $response->get(''));
    }

    public function testApiPositionGet()
    {
        $response = new Response();
        $request = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');
        
        $this->module->apiPositionGet($request, $response);
        
        self::assertEquals('Marketer', $response->get('')['name']);
        self::assertGreaterThan(0, $response->get('')['id']);
    }

    public function testApiPositionSet()
    {
        $response = new Response();
        $request = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');
        $request->setData('name', 'Test');

        $this->module->apiPositionSet($request, $response);
        $this->module->apiPositionGet($request, $response);

        self::assertEquals('Test', $response->get('')['name']);
    }

    public function testApiPositionCreateDelete()
    {
        $response = new Response();
        $request = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('name', 'test');
        $request->setData('status', Status::INACTIVE);
        $request->setData('description', 'test description');

        $this->module->apiPositionCreate($request, $response);

        self::assertEquals('test', $response->get('')['name']);
        self::assertGreaterThan(0, $response->get('')['id']);

        // test delete
        $request->setData('id', $response->get('')['id']);
        $this->module->apiPositionDelete($request, $response);

        self::assertGreaterThan(0, $response->get(''));
    }
}