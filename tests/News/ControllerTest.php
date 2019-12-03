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

namespace Modules\tests\News;

require_once __DIR__ . '/../Autoloader.php';

use Model\CoreSettings;
use Modules\Admin\Models\AccountPermission;
use Modules\News\Models\NewsStatus;
use Modules\News\Models\NewsType;
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

        $this->module = $this->app->moduleManager->get('News');

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    /**
     * @covers Modules\News\Controller\ApiController
     * @group module
     */
    public function testApiNewsCreate() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('title', 'Controller Test Title');
        $request->setData('plain', 'Controller Test Content');
        $request->setData('lang', 'en');
        $request->setData('type', NewsType::ARTICLE);
        $request->setData('status', NewsStatus::DRAFT);
        $request->setData('featred', true);

        $this->module->apiNewsCreate($request, $response);

        self::assertEquals('Controller Test Title', $response->get('')['response']->getTitle());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\News\Controller\ApiController
     * @group module
     */
    public function testApiNewsGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiNewsGet($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\News\Controller\ApiController
     * @group module
     */
    public function testApiNewsSet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('title', 'New Title');
        $request->setData('plain', 'New Content here');

        $this->module->apiNewsUpdate($request, $response);
        $this->module->apiNewsGet($request, $response);

        self::assertEquals('New Title', $response->get('')['response']->getTitle());
    }

    /**
     * @covers Modules\News\Controller\ApiController
     * @group module
     */
    public function testApiNewsDelete() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $this->module->apiNewsDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }
}
