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
namespace Modules\Navigation;

use Modules\Navigation\Models\NavigationType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;

/**
 * Navigation class.
 *
 * @category   Modules
 * @package    Modules\Navigation
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
     * JavaScript files.
     *
     * @var \string[]
     * @since 1.0.0
     */
    public static $js = [
        'backend',
    ];

    /**
     * CSS files.
     *
     * @var \string[]
     * @since 1.0.0
     */
    public static $css = [
    ];

    /**
     * Navigation array.
     *
     * Array of all navigation elements sorted by type->parent->id
     *
     * @var array
     * @since 1.0.0
     */
    public $nav = [];

    /**
     * Navigation array.
     *
     * Array of all navigation elements by id
     *
     * @var array
     * @since 1.0.0
     */
    public $nid = null;

    /**
     * Parent links of the current page.
     *
     * @var array
     * @since 1.0.0
     */
    public $nav_parents = null;

    /**
     * Module name.
     *
     * @var \string
     * @since 1.0.0
     */
    const MODULE_NAME = 'Navigation';

    /**
     * Localization files.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $localization = [
    ];

    /**
     * Providing.
     *
     * @var \string[]
     * @since 1.0.0
     */
    protected static $providing = [
    ];

    /**
     * Dependencies.
     *
     * @var \string[]
     * @since 1.0.0
     */
    protected static $dependencies = [
        'Admin',
    ];

    /**
     * Constructor.
     *
     * @param \Web\WebApplication $app Application
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * {@inheritdoc}
     */
    public function call(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $modules  = $this->app->moduleManager->getActiveModules();
        $language = $this->app->accountManager->get($request->getAccount())->getL11n()->getLanguage();

        foreach ($modules as $id => $module) {
            $this->app->accountManager->get($request->getAccount())->getL11n()->loadLanguage($language, 'Navigation', $module[0]['module_path']);
        }

        if (!empty($this->nav)) {
            $this->nav = [];

            $uri_hash = $request->getHash();
            $uri_pdo  = '';
            $i        = 1;
            foreach ($uri_hash as $hash) {
                $uri_pdo .= ':pid' . $i . ',';
                $i++;
            }

            $uri_pdo = rtrim($uri_pdo, ',');

            $sth = $this->app->dbPool->get('core')->con->prepare('SELECT * FROM `' . $this->app->dbPool->get('core')->prefix . 'nav` WHERE `nav_pid` IN(' . $uri_pdo . ') ORDER BY `nav_order` ASC');

            $i = 1;
            foreach ($uri_hash as $hash) {
                $sth->bindValue(':pid' . $i, $hash, \PDO::PARAM_STR);
                $i++;
            }

            $sth->execute();
            $temp_nav = $sth->fetchAll();

            foreach ($temp_nav as $link) {
                $this->nav[$link['nav_type']][$link['nav_subtype']][$link['nav_id']] = $link;
            }
        }

        switch ($data[0]) {
            case NavigationType::TOP:
                /** @noinspection PhpIncludeInspection */
                require __DIR__ . '/Theme/' . $request->getType() . '/top.tpl.php';
                break;
            case NavigationType::SIDE:
                /** @noinspection PhpIncludeInspection */
                require __DIR__ . '/Theme/' . $request->getType() . '/side.tpl.php';
                break;
            case NavigationType::CONTENT:
                /** @noinspection PhpIncludeInspection */
                require __DIR__ . '/Theme/' . $request->getType() . '/mid.tpl.php';
                break;
            case NavigationType::CONTENT_SIDE:
                /** @noinspection PhpIncludeInspection */
                require __DIR__ . '/Theme/' . $request->getType() . '/mid-side.tpl.php';
                break;
        }
    }
}
