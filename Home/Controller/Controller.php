<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Home
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Home\Controller;

use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;

/**
 * Home class.
 *
 * @package Modules\Home
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Controller extends ModuleAbstract implements WebInterface
{
    /**
     * Module path.
     *
     * @var   string
     * @since 1.0.0
     */
    public const MODULE_PATH = __DIR__ . '/../';

    /**
     * Module version.
     *
     * @var   string
     * @since 1.0.0
     */
    public const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var   string
     * @since 1.0.0
     */
    public const MODULE_NAME = 'Home';

    /**
     * Module id.
     *
     * @var   int
     * @since 1.0.0
     */
    public const MODULE_ID = 1006900000;

    /**
     * Providing.
     *
     * @var   string[]
     * @since 1.0.0
     */
    protected static array $providing = [];

    /**
     * Dependencies.
     *
     * @var   string[]
     * @since 1.0.0
     */
    protected static array $dependencies = [];
}
