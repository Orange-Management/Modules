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

namespace Modules\tests\News;

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
use phpOMS\Event\EventManager;

use Modules\News\Models\NewsStatus;
use Modules\News\Models\NewsType;

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
        $this->app->eventManager   = new EventManager();
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

        $this->module = ModuleFactory::getInstance('News', $this->app);

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    public function testApiNewsCreate()
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

        self::assertEquals('Controller Test Title', $response->get('')['response']['title']);
        self::assertGreaterThan(0, $response->get('')['response']['id']);
    }

    public function testApiNewsGet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiNewsGet($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']['id']);
    }

    public function testApiNewsSet()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('title', 'New Title');
        $request->setData('plain', 'New Content here');

        $this->module->apiNewsUpdate($request, $response);
        $this->module->apiNewsGet($request, $response);

        self::assertEquals('New Title', $response->get('')['response']['title']);
    }

    public function testApiNewsDelete()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $this->module->apiNewsDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']);
    }
}
