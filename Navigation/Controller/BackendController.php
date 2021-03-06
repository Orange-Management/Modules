<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Navigation
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Navigation\Controller;

use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Navigation class.
 *
 * @package Modules\Navigation
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#119
 *  Make navigation modifiable
 *  Navigation elements should be made modifiable in the module settings.
 *  In the module settings all navigation elements should be visible and the admin should be able to change them in the database.
 */
final class BackendController extends Controller
{
    /**
     * Create mid navigation
     *
     * @param int              $pageId   Page/parent Id for navigation
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     *
     * @return NavigationView
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function createNavigationMid(int $pageId, RequestAbstract $request, ResponseAbstract $response) : NavigationView
    {
        $nav = Navigation::getInstance($request,
            $this->app->accountManager->get($request->getHeader()->getAccount()),
            $this->app->dbPool,
            $this->app->orgId,
            $this->app->appName
        );

        $navView = new NavigationView($this->app->l11nManager, $request, $response);
        $navView->setTemplate('/Modules/Navigation/Theme/Backend/mid');
        $navView->setNav($nav->getNav());
        $navView->setParent($pageId);

        return $navView;
    }

    /**
     * Get basic navigation view
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     *
     * @return NavigationView
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function getView(RequestAbstract $request, ResponseAbstract $response) : NavigationView
    {
        $navObj = Navigation::getInstance(
            $request,
            $this->app->accountManager->get($request->getHeader()->getAccount()),
            $this->app->dbPool,
            $this->app->orgId,
            $this->app->appName
        );

        $nav = new \Modules\Navigation\Views\NavigationView($this->app->l11nManager, $request, $response);
        $nav->setNav($navObj->getNav());

        $unread = [];
        foreach ($this->receiving as $receiving) {
            $unread[$receiving] = $this->app->moduleManager->get($receiving)->openNav($request->getHeader()->getAccount());
        }

        $nav->setData('unread', $unread);

        return $nav;
    }

    /**
     * Load navigation language
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     *
     * @return void
     *
     * @todo Orange-Management/Modules#190 & Orange-Management/Modules#181
     *  The loading of the language file is slow since every module is loaded separately.
     *  This should either get cached per user or maybe put into one large language file per language (like the routes).
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function loadLanguage(RequestAbstract $request, ResponseAbstract $response) : void
    {
        $languages = $this->app->moduleManager->getLanguageFiles($request);
        $langCode  = $response->getHeader()->getL11n()->getLanguage();

        foreach ($languages as $path) {
            $path = __DIR__ . '/../../..' . $path . '.' . $langCode . '.lang.php';

            if (!\file_exists($path)) {
                continue;
            }

            /** @noinspection PhpIncludeInspection */
            $lang = include $path;

            $this->app->l11nManager->loadLanguage($langCode, 'Navigation', $lang);
        }
    }

    /**
     * @param int              $pageId   Page/parent Id for navigation
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     *
     * @return NavigationView
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function createNavigationSplash(int $pageId, RequestAbstract $request, ResponseAbstract $response) : NavigationView
    {
        $nav = Navigation::getInstance($request,
            $this->app->accountManager->get($request->getHeader()->getAccount()),
            $this->app->dbPool,
            $this->app->orgId,
            $this->app->appName
        );

        $navView = new NavigationView($this->app->l11nManager, $request, $response);

        $navView->setTemplate('/Modules/Navigation/Theme/Backend/splash');
        $navView->setNav($nav->getNav());
        $navView->setParent($pageId);

        return $navView;
    }
}
