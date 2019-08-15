<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Chat
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Chat\Controller;

use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;

/**
 * Chat controller class.
 *
 * @package    Modules\Chat
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
    public const MODULE_NAME = 'Chat';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1001800000;

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
