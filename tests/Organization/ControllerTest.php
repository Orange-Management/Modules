<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\tests\Organization;

require_once __DIR__ . '/../Autoloader.php';

use Model\CoreSettings;
use Modules\Admin\Models\AccountPermission;
use Modules\Organization\Models\Status;
use phpOMS\Account\Account;
use phpOMS\Account\AccountManager;
use phpOMS\Account\PermissionType;
use phpOMS\ApplicationAbstract;
use phpOMS\Dispatcher\Dispatcher;

use phpOMS\Event\EventManager;
use phpOMS\Message\Http\Request;

use phpOMS\Message\Http\Response;
use phpOMS\Module\ModuleManager;
use phpOMS\Router\WebRouter;

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
            protected string $appName = 'Api';
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
        $this->app->router = new WebRouter();

        $this->module = $this->app->moduleManager->get('Organization');

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiUnitGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiUnitGet($request, $response);

        self::assertEquals('Orange-Management', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiUnitSet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');
        $request->setData('name', 'OMS');

        $this->module->apiUnitSet($request, $response);
        $this->module->apiUnitGet($request, $response);

        self::assertEquals('OMS', $response->get('')['response']->getName());
    }

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiUnitCreateDelete() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('name', 'test');
        $request->setData('status', Status::INACTIVE);
        $request->setData('description', 'test description');

        $this->module->apiUnitCreate($request, $response);

        self::assertEquals('test', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());

        // test delete
        $request->setData('id', $response->get('')['response']->getId());
        $this->module->apiUnitDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    protected static $departmentId = 0;

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiDepartmentCreate() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('name', 'test');
        $request->setData('status', Status::INACTIVE);
        $request->setData('unit', 1);
        $request->setData('description', 'test description');

        $this->module->apiDepartmentCreate($request, $response);

        self::assertEquals('test', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());

        self::$departmentId = $response->get('')['response']->getId();
    }

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiDepartmentGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', self::$departmentId);

        $this->module->apiDepartmentGet($request, $response);

        self::assertEquals('test', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiDepartmentSet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', self::$departmentId);
        $request->setData('name', 'Production');

        $this->module->apiDepartmentSet($request, $response);
        $this->module->apiDepartmentGet($request, $response);

        self::assertEquals('Production', $response->get('')['response']->getName());
    }

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiDepartmentDelete() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', self::$departmentId);
        $this->module->apiDepartmentDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    protected static $positionId = 0;

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiPositionCreate() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('name', 'test');
        $request->setData('status', Status::INACTIVE);
        $request->setData('description', 'test description');

        $this->module->apiPositionCreate($request, $response);

        self::assertEquals('test', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
        self::$positionId = $response->get('')['response']->getId();
    }

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiPositionGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', self::$positionId);

        $this->module->apiPositionGet($request, $response);

        self::assertEquals('test', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiPositionSet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', self::$positionId);
        $request->setData('name', 'Test');

        $this->module->apiPositionSet($request, $response);
        $this->module->apiPositionGet($request, $response);

        self::assertEquals('Test', $response->get('')['response']->getName());
    }

    /**
     * @covers Modules\Organization\Controller\ApiController
     */
    public function testApiPositionDelete() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', self::$positionId);
        $this->module->apiPositionDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }
}
