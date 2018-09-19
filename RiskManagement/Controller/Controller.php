<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\RiskManagement
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Controller;

use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use Modules\RiskManagement\Models\SolutionMapper;
use Modules\RiskManagement\Models\CauseMapper;
use Modules\RiskManagement\Models\RiskMapper;
use Modules\RiskManagement\Models\DepartmentMapper;
use Modules\RiskManagement\Models\CategoryMapper;
use Modules\RiskManagement\Models\ProjectMapper;
use Modules\RiskManagement\Models\ProcessMapper;
use Modules\Organization\Models\UnitMapper;
use Modules\Organization\Models\Unit;

/**
 * Risk Management class.
 *
 * @package    Modules\RiskManagement
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
    public const MODULE_NAME = 'RiskManagement';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1003000000;

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
    protected static $dependencies = [
        'Media'
    ];
}
