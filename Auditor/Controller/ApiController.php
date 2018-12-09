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
use phpOMS\Utils\StringUtils;

use Modules\Auditor\Models\Audit;
use Modules\Auditor\Models\AuditMapper;

/**
 * Auditor api controller class.
 *
 * @package    Modules\Auditor
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Log model creation
     *
     * @param mixed  $account Account who created the model
     * @param mixed  $old     Old value (always null)
     * @param mixed  $new     New value
     * @param int    $type    Module model type
     * @param int    $subtype Module model subtype
     * @param string $module  Module name
     * @param string $ref     Reference to other model
     * @param string $content Message
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
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
        $newString = StringUtils::stringify($new);
        $audit     = new Audit($account, null, $newString, $type, $subtype, $module, $ref, $content);

        AuditMapper::create($audit);
    }

    /**
     * Log model update
     *
     * @param mixed  $account Account who created the model
     * @param mixed  $old     Old value
     * @param mixed  $new     New value
     * @param int    $type    Module model type
     * @param int    $subtype Module model subtype
     * @param string $module  Module name
     * @param string $ref     Reference to other model
     * @param string $content Message
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
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
        $oldString = StringUtils::stringify($old);
        $newString = StringUtils::stringify($new);
        $audit     = new Audit($account, $oldString, $newString, $type, $subtype, $module, $ref, $content);

        AuditMapper::create($audit);
    }

    /**
     * Log model delete
     *
     * @param mixed  $account Account who created the model
     * @param mixed  $old     Old value
     * @param mixed  $new     New value (always null)
     * @param int    $type    Module model type
     * @param int    $subtype Module model subtype
     * @param string $module  Module name
     * @param string $ref     Reference to other model
     * @param string $content Message
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
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
        $oldString = StringUtils::stringify($old);
        $audit     = new Audit($account, $oldString, null, $type, $subtype, $module, $ref, $content);

        AuditMapper::create($audit);
    }
}
