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

namespace Modules\tests\Media;

use Model\CoreSettings;
use Modules\Admin\Models\AccountPermission;
use Modules\Media\Models\UploadStatus;
use phpOMS\Account\Account;
use phpOMS\Account\AccountManager;
use phpOMS\Account\PermissionType;
use phpOMS\ApplicationAbstract;
use phpOMS\Dispatcher\Dispatcher;
use phpOMS\Event\EventManager;
use phpOMS\Message\Http\Request;
use phpOMS\Message\Http\Response;
use phpOMS\Router\Router;
use phpOMS\Module\ModuleManager;
use phpOMS\Uri\Http;
use phpOMS\Utils\TestUtils;

require_once __DIR__ . '/../Autoloader.php';

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
        $this->app->appSettings    = new CoreSettings($this->app->dbPool->get());
        $this->app->moduleManager  = new ModuleManager($this->app, __DIR__ . '/../../../Modules');
        $this->app->dispatcher     = new Dispatcher($this->app);
        $this->app->eventManager   = new EventManager($this->app->dispatcher);
        $this->app->eventManager->importFromFile(__DIR__ . '/../../../Web/Api/Hooks.php');

        $this->app->router = new Router();

        $this->module = $this->app->moduleManager->get('Media');
    }

    public function testCreateDbEntries() : void
    {
        $status = [
            [
                'status' => UploadStatus::OK,
                'extension' => 'png',
                'filename' => 'logo.png',
                'name' => 'logo.png',
                'path' => 'Modules/tests/Media/Files/',
                'size' => 90210,
            ],
            [
                'status' => UploadStatus::FAILED_HASHING,
                'extension' => 'png',
                'filename' => 'logo.png',
                'name' => 'logo.png',
                'path' => 'Modules/tests/Media/Files/',
                'size' => 90210,
            ],
            [
                'status' => UploadStatus::OK,
                'extension' => 'png',
                'filename' => 'logo2.png',
                'name' => 'logo2.png',
                'path' => 'Modules/tests/Media/Files/',
                'size' => 90210,
            ],
        ];

        $ids = $this->module->createDbEntries($status, 1);
        self::assertEquals(2, \count($ids));
    }
}
