<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\DatabaseEditor\Controller;

use Model\Settings;

use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Admin controller class.
 *
 * This class is responsible for the basic admin activities such as managing accounts, groups, permissions and modules.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Api method for modifying settings
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
    public function apiQueryExecute(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $config = $this->createDbConfigFromRequest($request);
        $con    = ConnectionFactory::create($config);
        $buider = new Builder($con);
        $builder->raw($request->getData('query') ?? '');

        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Query', 'Query response', $builder->execute());
    }

    /**
     * Api method in order to test database connection
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
    public function apiConnectionTest(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $config = $this->createDbConfigFromRequest($request);
        $con    = ConnectionFactory::create($config);

        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Query', 'Query response', $con->getStatus());
    }

    /**
     * Create database connection config from request data
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function createDbConfigFromRequest(RequestAbstract $request) : array
    {
        return [
            'db'       => $request->getData('type') ?? '',
            'host'     => $request->getData('host') ?? '',
            'port'     => $request->getData('port') ?? '',
            'database' => $request->getData('database') ?? '',
            'login'    => $request->getData('login') ?? '',
            'password' => $request->getData('password') ?? '',
        ];
    }
}
