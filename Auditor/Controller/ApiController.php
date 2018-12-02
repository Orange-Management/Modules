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
use phpOMS\Account\Account;
use phpOMS\Account\PermissionType;
use phpOMS\DataStorage\Database\RelationType;

use Modules\Auditor\Models\Audit;
use Modules\Auditor\Models\AuditMapper;

final class ApiController extends Controller
{
    public function apiLogCreate(
        Account $account,
        $old,
        $new,
        int $type = 0,
        int $subtype = 0,
        string $module = null,
        string $ref = null,
        string $content = null
    ) : void
    {
        $audit = new Audit($account, null, $new->__toString(), $type, $subtype, $module, $ref, $content);
        AuditMapper::create($audit);
    }

    public function apiLogUpdate(
        Account $account,
        $old,
        $new,
        int $type = 0,
        int $subtype = 0,
        string $module = null,
        string $ref = null,
        string $content = null
    ) : void
    {
        $audit = new Audit($account, $old->__toString(), $new->__toString(), $type, $subtype, $module, $ref, $content);
        AuditMapper::create($audit);
    }

    public function apiLogDelete(
        Account $account,
        $old,
        $new,
        int $type = 0,
        int $subtype = 0,
        string $module = null,
        string $ref = null,
        string $content = null
    ) : void
    {
        $audit = new Audit($account, $new->__toString(), null, $type, $subtype, $module, $ref, $content);
        AuditMapper::create($audit);
    }
}
