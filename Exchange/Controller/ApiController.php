<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Exchange
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Controller;

use Modules\Exchange\Models\InterfaceManagerMapper;

use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Exchange controller class.
 *
 * @package Modules\Exchange
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ApiController extends Controller
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
     * @since 1.0.0
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
            'status' => $status,
            'title' => 'Exchange',
            'message' => $message,
        ]);
    }

    /**
     * Method to import data based on a request
     *
     * @param RequestAbstract $request Request
     *
     * @return bool
     *
     * @since 1.0.0
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

    /**
     * Api method to export data
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiExchangeExport(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
    }
}
