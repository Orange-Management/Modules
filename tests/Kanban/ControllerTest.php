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

namespace Modules\tests\Kanban;

require_once __DIR__ . '/../Autoloader.php';

use Modules\Admin\Models\AccountPermission;
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

    protected function setUp() : void
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

        $this->module = ModuleFactory::getInstance('Kanban', $this->app);

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    public function testCreateBoard() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('title', 'Controller Test Board');
        $request->setData('plain', 'Controller Test Description');

        $this->module->apiKanbanBoardCreate($request, $response);

        self::assertEquals('Controller Test Board', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testCreateColumn() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('title', 'Controller Test Column');
        $request->setData('board', 1);

        $this->module->apiKanbanColumnCreate($request, $response);

        self::assertEquals('Controller Test Column', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    public function testCreateCard() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('title', 'Controller Test Card');
        $request->setData('plain', 'Controller Test Description');
        $request->setData('column', '1');

        $this->module->apiKanbanCardCreate($request, $response);

        self::assertEquals('Controller Test Card', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }
}