<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Tasks
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tasks\Controller;

use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;

/**
 * Task class.
 *
 * @package    Modules\Tasks
 * @license    OMS License 1.0
 * @link       https://orange-management.org
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
    public const MODULE_NAME = 'Tasks';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1001100000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $providing = [
        'Navigation',
    ];

    /**
     * Dependencies.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $dependencies = [];
}
