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
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\Task;

require_once __DIR__ . '/../Autoloader.php';

use Model\CoreSettings;
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

        $this->module = $this->app->moduleManager->get('Tasks');

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    public function testCreateTask() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('title', 'Controller Test Title');
        $request->setData('plain', 'Controller Test Description');
        $request->setData('due', (new \DateTime())->format('Y-m-d H:i:s'));

        $this->module->apiTaskCreate($request, $response);

        self::assertEquals('Controller Test Title', $response->get('')['response']->getTitle());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiTaskGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiTaskGet($request, $response);

        self::assertEquals(1, $response->get('')['response']->getId());
    }

    public function testApiTaskSet() : void
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

    public function testCreateTaskElement() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('due', (new \DateTime())->format('Y-m-d H:i:s'));
        $request->setData('priority', TaskPriority::HIGH);
        $request->setData('status', TaskStatus::DONE);
        $request->setData('task', 1);
        $request->setData('plain', 'Controller Test');

        $this->module->apiTaskElementCreate($request, $response);

        self::assertEquals('Controller Test', $response->get('')['response']->getDescriptionRaw());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testApiTaskElementGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiTaskElementGet($request, $response);

        self::assertEquals(1, $response->get('')['response']->getId());
    }

    public function testApiTaskElementSet() : void
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

    public function testInvalidTaskCreate() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('plain', 'Controller Test Description');
        $request->setData('due', (new \DateTime())->format('Y-m-d H:i:s'));

        $this->module->apiTaskCreate($request, $response);

        self::assertNotEquals([], $response->get(''));
    }

    public function testInvalidTaskElementCreate() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('due', (new \DateTime())->format('Y-m-d H:i:s'));
        $request->setData('priority', TaskPriority::HIGH);
        $request->setData('status', TaskStatus::DONE);
        $request->setData('plain', 'Controller Test');

        $this->module->apiTaskElementCreate($request, $response);

        self::assertNotEquals([], $response->get(''));
    }
}
