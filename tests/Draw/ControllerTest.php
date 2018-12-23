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

namespace Modules\tests\Draw;

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

        $this->module = ModuleFactory::getInstance('Draw', $this->app);

        TestUtils::setMember($this->module, 'app', $this->app);
    }

    public function testCreateDraw()
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('title', 'Draw Title');
        $request->setData('image', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABIkAAACbCAYAAADm48vbAAAgAElEQVR4nOyddbiU5faGbzCwwD6KAbZii9hiYItYmNiBinpQsbDj2InFURGVUlEMEAvFbo6CGFigKGJggYXJ749n5rdnb2b2nvhy5rmva1/Kjpl3Zr7vjWet9SwwxiSdlsAbQK+4B2KMMcYYY4wxxhhj4qELMANoH/dAjDHGGGOMMcYYY0w8XA2MiHsQxhhjjDHGGGOMMSYeXF5mjDHGGGOMMcYYU+O4vMwYY4wxxhhjjDGmxnF5mTHGGGOMMcYYY0wN0wqXlxljjDHGGGOMMcbUNLsC03F5mTHGGGOMMcYYY0zNcg0wPO5BGGOMMcYYY4wxxph4aAW8CZwU90CMMcYYY4wxxhhjTDxky8vWi3sgxhhjjDHGGGOMMSYeXF5mjDHGGGOMMcYYU8O4vMwYY4wxxhhjjDGmxnF5mTHGGGOMMcYYY0yNcy0uLzPGGGOMMcYYY4ypWRYExgInxj0QY4wxxhhjjDHGGBMPuwE/AuvGPRBjjDHGGGOMMcYYEw/XAg/FPQhjjDHGGGOMMcYYEw8uLzPGGGOMMcYYY4ypcVxeZowxxhhjjDHGGFPjuLzMGGOMMcYYY4wxpoZphcvLjDHGGGOMMcYYUySt4x6ACYXOwDO4vMwYY4wxxhhjjDFFsgEwNO5BmEC5FBgZ9yCMMcYYY4wxxhiTPvYB/gH2insgpmJeAHrHPQhjjDHGGGOMMcakl2bAfTirKK1sDszK/NcYY4wxxhhjjDGmYrJZRbvEPRBTNL1RBpExxhhjjDHGGGNMoDQDrsNZRWlgJPIgMsYYY4wxxhhjjAkNexUll7WA6aiLmTHGGGOMMcYYY0zo2KsoefQAxgOt4h6IMcYYY4wxxhhjag9nFSWDIUDfuAdhjDHGGGMSx/LA+jlfK8Y7HGOMMdWOs4riow3wGdAt7oEYY4wxxphEsQHanz8M/C/n6wVg4xjHZYwxpk');

        $this->module->apiDrawCreate($request, $response);

        self::assertEquals('Draw Title', $response->get('')['response']->getMedia()->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }
}