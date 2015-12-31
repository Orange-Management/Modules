<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Address;

use phpOMS\Message\RequestDestination;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;

/**
 * Sales class.
 *
 * @category   Modules
 * @package    Modules\Accountsreceivable
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var \string
     * @since 1.0.0
     */
    const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var \string
     * @since 1.0.0
     */
    const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var \string
     * @since 1.0.0
     */
    const MODULE_NAME = 'Address';

    /**
     * Localization files.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $localization = [
        RequestDestination::BACKEND => [''],
    ];

    /**
     * Routing elements.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $routes = [
    ];

    /**
     * Providing.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $providing = [
    ];

    /**
     * Dependencies.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];
}
