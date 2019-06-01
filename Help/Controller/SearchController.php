<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Help
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Help\Controller;

use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Help class.
 *
 * @package    Modules\Help
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class SearchController extends Controller
{
    /**
     * Api method to create a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return array
     *
     * @api
     *
     * @since  1.0.0
     */
    public function searchHelp(RequestAbstract $request, ResponseAbstract $response, $data = null) : array
    {
        return ['found'];
    }
}
