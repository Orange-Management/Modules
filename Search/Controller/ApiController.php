<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Search
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Search\Controller;

use phpOMS\ApplicationAbstract;
use phpOMS\Router\Router;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\System\MimeType;
use phpOMS\Message\NotificationLevel;

/**
 * Api controller
 *
 * @package    Modules\Search
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class ApiController extends Controller
{
    private $router = null;

    /**
     * {@inheritdoc}
     */
    public function __construct(ApplicationAbstract $app)
    {
        parent::__construct($app);

        $this->router = new Router();
        $this->router->importFromFile(__DIR__ . '/../SearchCommands.php');
    }

    /**
     * Api method to handle basic search request
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
    public function routeSearch(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $searchResults = $this->app->dispatcher->dispatch(
            $this->router->route(
                $request->getData('search') ?? '',
                $request->getData('CSRF'),
                $request->getRouteVerb(),
                $this->app->appName,
                $this->app->orgId,
                $this->app->accountManager->get($request->getHeader()->getAccount())
            ),
            $request,
            $response
        );

        $response->getHeader()->set('Content-Type', MimeType::M_JSON . '; charset=utf-8', true);
        $response->set($request->getUri()->__toString(), [
            'status'   => NotificationLevel::HIDDEN,
            'response' => $searchResults,
        ]);
    }
}
