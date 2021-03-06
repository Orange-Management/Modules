<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Help
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Help\Controller;

use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Utils\Parser\Markdown\Markdown;
use phpOMS\Views\View;

/**
 * Help class.
 *
 * @package Modules\Help
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#200
 *  Currently only the end-user help documentation is shown in the modules.
 *  Implement the help documentation for developers as well.
 */
final class BackendController extends Controller
{
    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewHelp(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Help/Theme/Backend/help');

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewHelpGeneral(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $path = $this->getHelpGeneralPath($request);

        $toParse = \file_get_contents($path);
        $summary = \file_get_contents(__DIR__ . '/../../../Documentation/SUMMARY.md');

        $content    = Markdown::parse($toParse === false ? '' : $toParse);
        $navigation = Markdown::parse($summary === false ? '' : $summary);

        $view->setTemplate('/Modules/Help/Theme/Backend/help-general');
        $view->setData('content', $content);
        $view->setData('navigation', $navigation);

        return $view;
    }

    /**
     * Create markdown parsing path
     *
     * @param RequestAbstract $request Request
     *
     * @return string
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    private function getHelpGeneralPath(RequestAbstract $request) : string
    {
        if ($request->getData('page') === 'README' || $request->getData('page') === null) {
            $path = \realpath(__DIR__ . '/../../../Documentation/README.md');
        } else {
            $path = \realpath(__DIR__ . '/../../../Documentation/' . $request->getData('page') . '.md');
        }

        if ($path === false) {
            $path = \realpath(__DIR__ . '/../../../Documentation/README.md');
        }

        return $path === false ? '' : $path;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewHelpModuleList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Help/Theme/Backend/help-module-list');

        $view->setData('modules', $this->app->moduleManager->getInstalledModules());

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewHelpModule(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $active = $this->app->moduleManager->getActiveModules();

        if ($request->getData('id') === null || !isset($active[$request->getData('id')])) {
            return $this->viewHelpModuleList($request, $response, $data);
        }

        $view = new View($this->app->l11nManager, $request, $response);
        $path = $this->getHelpModulePath($request);

        $toParse = \file_get_contents($path);
        $summary = \file_get_contents(__DIR__ . '/../../' . $request->getData('id') . '/Docs/Help/en/SUMMARY.md');

        $content    = Markdown::parse($toParse === false ? '' : $toParse);
        $navigation = Markdown::parse($summary === false ? '' : $summary);

        $view->setTemplate('/Modules/Help/Theme/Backend/help-module');
        $view->setData('content', $content);
        $view->setData('navigation', $navigation);

        return $view;
    }

    /**
     * Create markdown parsing path
     *
     * @param RequestAbstract $request Request
     *
     * @return string
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    private function getHelpModulePath(RequestAbstract $request) : string
    {
        if ($request->getData('page') === 'table-of-contencts' || $request->getData('page') === null) {
            $page = 'introduction';
        } else {
            $page = $request->getData('page');
        }

        $path = \realpath(__DIR__ . '/../../' . $request->getData('id') . '/Docs/Help/en/' . $page . '.md');
        if ($path === false) {
            $path = \realpath(__DIR__ . '/../../' . $request->getData('id') . '/Docs/Help/en/introduction.md');
        }

        return $path === false ? '' : $path;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewHelpDeveloper(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $path = $this->getHelpDeveloperPath($request);

        $toParse = \file_get_contents($path);
        $summary = \file_get_contents(__DIR__ . '/../../../Developer-Guide/SUMMARY.md');

        $content    = Markdown::parse($toParse === false ? '' : $toParse);
        $navigation = Markdown::parse($summary === false ? '' : $summary);

        $view->setTemplate('/Modules/Help/Theme/Backend/help-developer');
        $view->setData('content', $content);
        $view->setData('navigation', $navigation);

        return $view;
    }

    /**
     * Create markdown parsing path
     *
     * @param RequestAbstract $request Request
     *
     * @return string
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    private function getHelpDeveloperPath(RequestAbstract $request) : string
    {
        if ($request->getData('page') === 'README' || $request->getData('page') === null) {
            $path = \realpath(__DIR__ . '/../../../Developer-Guide/README.md');
        } else {
            $path = \realpath(__DIR__ . '/../../../Developer-Guide/' . $request->getData('page') . '.md');
        }

        if ($path === false) {
            $path = \realpath(__DIR__ . '/../../../Developer-Guide/README.md');
        }

        return $path === false ? '' : $path;
    }
}
