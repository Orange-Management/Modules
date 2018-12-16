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

namespace Modules\tests\Task;

require_once __DIR__ . '/../Autoloader.php';

use Modules\Admin\Models\AccountPermission;
use Modules\Tasks\Models\TaskPriority;
use Modules\Tasks\Models\TaskStatus;
use phpOMS\Account\Account;
use phpOMS\Account\AccountManager;
use phpOMS\Account\PermissionType;
use phpOMS\ApplicationAbstract;
use phpOMS\Dispatcher\Dispatcher;
use phpOMS\Event\EventManager;
use phpOMS\Message\Http\Request;
use phpOMS\Message\Http\Response;
use phpOMS\Module\ModuleFactory;
use phpOMS\Router\Router;
use phpOMS\Uri\Http;
use phpOMS\Utils\TestUtils;

class ControllerTest extends \PHPUnit\Framework\TestCase
{
    protected $app    = null;
    protected $module = null;

    protected function setUp()
    {
        $this->app = new class extends ApplicationAbstract
        {
            protected $appName = 'Api';
        };

        $this->app->dbPool         = $GLOBALS['dbpool'];
        $this->app->orgId          = 1;
        $this->app->appName        = 'Backend';
        $this->app->accountManager = new AccountManager($GLOBALS['session']);
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

        $this->module = ModuleFactory::getInstance('Tasks', $this->app);

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    public function testCreateTask()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('title', 'Controller Test Title');
        $request->setData('plain', 'Controller Test Description');
        $request->setData('due', (new \DateTime)->format('Y-m-d H:i:s'));

        $this->module->apiTaskCreate($request, $response);

        self::assertEquals('Controller Test Title', $response->get('')['response']->getTitle());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiTaskGet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiTaskGet($request, $response);

        self::assertEquals(1, $response->get('')['response']->getId());
    }

    public function testApiTaskSet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('title', 'New Title');
        $request->setData('description', 'New Content here');

        $this->module->apiTaskSet($request, $response);
        $this->module->apiTaskGet($request, $response);

        self::assertEquals('New Title', $response->get('')['response']->getTitle());
    }

    public function testCreateTaskElement()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('forward', 1);
        $request->setData('due', (new \DateTime)->format('Y-m-d H:i:s'));
        $request->setData('priority', TaskPriority::HIGH);
        $request->setData('status', TaskStatus::DONE);
        $request->setData('task', 1);
        $request->setData('plain', 'Controller Test');

        $this->module->apiTaskElementCreate($request, $response);

        self::assertEquals('Controller Test', $response->get('')['response']->getDescriptionRaw());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiTaskElementGet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiTaskElementGet($request, $response);

        self::assertEquals(1, $response->get('')['response']->getId());
    }

    public function testApiTaskElementSet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('description', 'This is a changed description');

        $this->module->apiTaskElementSet($request, $response);
        $this->module->apiTaskElementGet($request, $response);

        self::assertEquals('This is a changed description', $response->get('')['response']->getDescriptionRaw());
    }
}
