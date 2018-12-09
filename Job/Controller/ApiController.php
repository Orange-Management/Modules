<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Job
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Job\Controller;

use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Task class.
 *
 * @package    Modules\Job
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class ApiController extends Controller
{
    public function apiJobCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
    }
}
