<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Knowledgebase
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Controller;

use Modules\Knowledgebase\Models\NullWikiCategory;
use Modules\Knowledgebase\Models\NullWikiDoc;
use Modules\Knowledgebase\Models\PermissionState;
use Modules\Knowledgebase\Models\WikiCategoryMapper;
use Modules\Knowledgebase\Models\WikiDocMapper;

use phpOMS\Account\PermissionType;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Task class.
 *
 * @package    Modules\Knowledgebase
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class BackendController extends Controller
{

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setUpBackend(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Knowledgebase/Theme/Backend/styles.css');
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewKnowledgebaseDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Knowledgebase/Theme/Backend/wiki-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005901001, $request, $response));

        $list = WikiCategoryMapper::getNewest(50);
        $view->setData('categories', $list);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewKnowledgebaseCategoryList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Knowledgebase/Theme/Backend/wiki-category-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005901001, $request, $response));

        $list = WikiCategoryMapper::getAll();
        $view->setData('categories', $list);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewKnowledgebaseDocList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Knowledgebase/Theme/Backend/wiki-doc-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005901001, $request, $response));

        $list = WikiDocMapper::getAll();
        $view->setData('docs', $list);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewKnowledgebaseCategory(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Knowledgebase/Theme/Backend/wiki-category-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005901001, $request, $response));

        $category = WikiCategoryMapper::get((int) $request->getData('id'));
        $view->setData('category', $category);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewKnowledgebaseCategoryCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Knowledgebase/Theme/Backend/wiki-category-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005901001, $request, $response));

        $view->setData('category', new NullWikiCategory());

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewKnowledgebaseDoc(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $category  = WikiDocMapper::get((int) $request->getData('id'));
        $accountId = $request->getHeader()->getAccount();

        if (!$this->app->accountManager->get($accountId)->hasPermission(
                PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DOC, $category->getId())
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Knowledgebase/Theme/Backend/wiki-category-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005901001, $request, $response));
        $view->setData('category', $category);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewKnowledgebaseDocCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Knowledgebase/Theme/Backend/wiki-category-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005901001, $request, $response));

        $view->setData('category', new NullWikiDoc());

        return $view;
    }
}
