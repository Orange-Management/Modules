<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Auditor
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Auditor\Controller;

use Modules\Admin\Models\NullAccount;
use Modules\Auditor\Models\Audit;
use Modules\Auditor\Models\AuditMapper;

use phpOMS\Account\Account;
use phpOMS\Utils\StringUtils;

/**
 * Auditor api controller class.
 *
 * @package Modules\Auditor
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#111
 *  Implement blockchain for audited elements
 *  Blockchain should be implemented in order to allow auditors to validate that data hasn't been changed.
 *  This is mostly important for accounting and accounting related data.
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
     * @since 1.0.0
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
        $newString = StringUtils::stringify($new, \JSON_PRETTY_PRINT);
        $audit     = new Audit(new NullAccount($account), null, $newString, $type, $subtype, $module, $ref, $content);

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
     * @since 1.0.0
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
        $oldString = StringUtils::stringify($old, \JSON_PRETTY_PRINT);
        $newString = StringUtils::stringify($new, \JSON_PRETTY_PRINT);
        $audit     = new Audit(new NullAccount($account), $oldString, $newString, $type, $subtype, $module, $ref, $content);

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
     * @since 1.0.0
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
        $oldString = StringUtils::stringify($old, \JSON_PRETTY_PRINT);
        $audit     = new Audit(new NullAccount($account), $oldString, null, $type, $subtype, $module, $ref, $content);

        AuditMapper::create($audit);
    }
}
