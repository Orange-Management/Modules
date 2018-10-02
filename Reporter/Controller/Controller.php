<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Reporter
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Reporter\Controller;

use phpOMS\Model\Message\Redirect;
use Modules\Media\Models\Collection;
use Modules\Media\Models\CollectionMapper;
use Modules\Media\Models\Media;
use Modules\Media\Models\MediaMapper;
use Modules\Reporter\Models\NullReport;
use Modules\Reporter\Models\Report;
use Modules\Reporter\Models\ReportMapper;
use Modules\Reporter\Models\Template;
use Modules\Reporter\Models\TemplateDataType;
use Modules\Reporter\Models\TemplateMapper;
use Modules\Reporter\Models\PermissionState;
use phpOMS\Asset\AssetType;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Html\Head;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\System\MimeType;
use phpOMS\Utils\IO\Csv\CsvDatabaseMapper;
use phpOMS\Utils\IO\Excel\ExcelDatabaseMapper;
use phpOMS\Utils\StringUtils;
use phpOMS\Views\View;
use phpOMS\Account\PermissionType;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * TODO: Implement auto sqlite generator on upload
 */

/**
 * Reporter controller class.
 *
 * @package    Modules\Reporter
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.
 * @link       http://orange-managementcom
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_PATH = __DIR__ . '/../';

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_NAME = 'Reporter';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1002700000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $dependencies = [];
}
