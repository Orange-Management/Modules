<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\CreditManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\CreditManagement\Controller;

use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;

/**
 * Credit Management controller class.
 *
 * @package Modules\CreditManagement
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
     * Module name.
     *
     * @var   string
     * @since 1.0.0
     */
    public const MODULE_NAME = 'CreditManagement';

    /**
     * Module version.
     *
     * @var   string
     * @since 1.0.0
     */
    public const MODULE_VERSION = '1.0.0';

    /**
     * Module id.
     *
     * @var   int
     * @since 1.0.0
     */
    public const MODULE_ID = 1002300000;

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
