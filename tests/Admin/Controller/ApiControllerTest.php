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

namespace Modules\tests\Admin\Controller;

require_once __DIR__ . '/../../Autoloader.php';

use Model\CoreSettings;

use Modules\Admin\Models\AccountPermission;

use Modules\tests\Admin\Controller\Api\ApiControllerAccountTrait;
use Modules\tests\Admin\Controller\Api\ApiControllerGroupTrait;
use Modules\tests\Admin\Controller\Api\ApiControllerModuleTrait;
use Modules\tests\Admin\Controller\Api\ApiControllerPermissionTrait;
use Modules\tests\Admin\Controller\Api\ApiControllerSettingsTrait;

use phpOMS\Account\Account;
use phpOMS\Account\AccountManager;
use phpOMS\Account\PermissionType;
use phpOMS\Application\ApplicationAbstract;
use phpOMS\Dispatcher\Dispatcher;
use phpOMS\Event\EventManager;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\ModuleManager;
use phpOMS\Router\WebRouter;
use phpOMS\Utils\TestUtils;

/**
 * @testdox Modules\tests\Admin\Controller\ApiControllerTest: Admin api controller
 *
 * @internal
 */
class ApiControllerTest extends \PHPUnit\Framework\TestCase
{
    protected ApplicationAbstract $app;
    protected ModuleAbstract $module;

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
        $this->app->moduleManager  = new ModuleManager($this->app, __DIR__ . '/../../../../Modules');
        $this->app->dispatcher     = new Dispatcher($this->app);
        $this->app->eventManager   = new EventManager($this->app->dispatcher);
        $this->app->eventManager->importFromFile(__DIR__ . '/../../../../Web/Api/Hooks.php');

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

        $this->module = $this->app->moduleManager->get('Admin');

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    use ApiControllerSettingsTrait;
    use ApiControllerAccountTrait;
    use ApiControllerGroupTrait;
    use ApiControllerPermissionTrait;
    use ApiControllerModuleTrait;
}
