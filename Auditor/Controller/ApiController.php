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
        $account,
        $old,
        $new,
        int $type = 0,
        int $subtype = 0,
        string $module = null,
        string $ref = null,
        string $content = null
    ) : void
    {
        $newString = $this->stringify($new);
        $audit     = new Audit($account, null, $newString, $type, $subtype, $module, $ref, $content);

        AuditMapper::create($audit);
    }

    public function apiLogUpdate(
        $account,
        $old,
        $new,
        int $type = 0,
        int $subtype = 0,
        string $module = null,
        string $ref = null,
        string $content = null
    ) : void
    {
        $oldString = $this->stringify($old);
        $newString = $this->stringify($new);
        $audit     = new Audit($account, $oldString, $newString, $type, $subtype, $module, $ref, $content);

        AuditMapper::create($audit);
    }

    public function apiLogDelete(
        $account,
        $old,
        $new,
        int $type = 0,
        int $subtype = 0,
        string $module = null,
        string $ref = null,
        string $content = null
    ) : void
    {
        $oldString = $this->stringify($old);
        $audit     = new Audit($account, $oldString, null, $type, $subtype, $module, $ref, $content);

        AuditMapper::create($audit);
    }

    private function stringify($element) : ?string
    {
        $stringified = '';

        if ($element instanceof \JsonSerializable) {
            $stringified = \json_encode($element);
        } elseif ($element instanceof \Serializable) {
            $stringified = $element->serialize();
        } elseif (\is_string($element)) {
            $stringified = $element;
        } elseif ($element === null) {
            return null;
        } else {
            $stringified = $element->__toString();
        }

        return $stringified;
    }
}
