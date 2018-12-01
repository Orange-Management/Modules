<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Auditor
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Auditor\Controller;

use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Message\NotificationLevel;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Views\View;
use phpOMS\Account\PermissionType;
use phpOMS\DataStorage\Database\RelationType;

final class ApiController extends Controller
{
}