<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Exchange
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Exchange\Controller;

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
 * @package    Modules\Exchange
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class ApiController extends Controller
{

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
