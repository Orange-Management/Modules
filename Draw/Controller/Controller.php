<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Draw
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Draw\Controller;

use Model\Message\FormValidation;
use Modules\Draw\Models\DrawImage;
use Modules\Draw\Models\DrawImageMapper;
use Modules\Draw\Models\PermissionState;
use Modules\Media\Models\UploadStatus;
use phpOMS\Asset\AssetType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Html\Head;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use Modules\Media\Controller as MediaController;
use phpOMS\System\File\Local\File;
use phpOMS\Utils\ImageUtils;
use phpOMS\Views\View;
use phpOMS\Account\PermissionType;
use phpOMS\Message\Http\RequestStatusCode;

/**
 * Calendar controller class.
 *
 * @package    Modules\Draw
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
    public const MODULE_NAME = 'Draw';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1005200000;

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
