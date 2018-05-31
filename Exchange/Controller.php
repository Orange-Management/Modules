<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Exchange;

use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;

use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Message\NotificationLevel;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Account\PermissionType;

use Modules\Exchange\Models\InterfaceManager;
use Modules\Exchange\Models\InterfaceManagerMapper;
use Modules\Exchange\Models\PermissionState;

/**
 * Exchange controller class.
 *
 * @package    Modules
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_NAME = 'Exchange';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1007000000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];

    public function viewExchangeDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        return $view;
    }

    public function viewExchangeExportList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-export-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        $interfaces = InterfaceManagerMapper::getAll();

        $export = [];
        foreach ($interfaces as $interface) {
            if ($interface->hasExport()) {
                $export[] = $interface;
            }
        }

        $view->addData('interfaces', $export);

        return $view;
    }

    public function viewExchangeImportList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-import-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        $interfaces = InterfaceManagerMapper::getAll();

        $import = [];
        foreach ($interfaces as $interface) {
            if ($interface->hasImport()) {
                $import[] = $interface;
            }
        }

        $view->addData('interfaces', $import);

        return $view;
    }

    public function viewExchangeExport(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-export');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        return $view;
    }

    public function viewExchangeImport(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Exchange/Theme/Backend/exchange-import');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007001001, $request, $response));

        $interface = InterfaceManagerMapper::get((int) $request->getData('id'));

        $view->addData('interface', $interface);

        $lang = include __DIR__ . '/Interfaces/' . $interface->getInterfacePath() . '/' . $response->getHeader()->getL11n()->getLanguage() . '.lang.php';
        $view->addData('lang', $lang);

        return $view;
    }

    /**
     * Api method to import data
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiExchangeImport(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::IMPORT)
        ) {
            $response->set('exchange_import', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $import  = $this->importDataFromRequest($request);
        $status  = NotificationLevel::ERROR;
        $message = 'Import failed.';

        if ($import) {
            $status  = NotificationLevel::OK;
            $message = 'Import succeeded.';
        }

        $response->set($request->getUri()->__toString(), [
            'status' => status,
            'title' => 'Exchange',
            'message' => $message
        ]);
    }

    /**
     * Method to import data based on a request
     *
     * @param RequestAbstract $request Request
     *
     * @return bool
     *
     * @since  1.0.0
     */
    private function importDataFromRequest(RequestAbstract $request) : bool
    {
        $interfaces = InterfaceManagerMapper::getAll();
        foreach ($interfaces as $interface) {
            if ($request->getData('exchange') ?? '' === $interface->getInterfacePath()) {
                $class    = '\\Modules\\Exchange\\Interfaces\\' . $interface->getInterfacePath() . '\\Importer';
                $importer = new $class($this->app->dbPool->get());

                return $importer->importFromRequest($request);
            }
        }

        return false;
    }
}
