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
namespace Modules\News;

use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;
use Modules\News\Models\NewsArticle;
use Modules\News\Models\NewsArticleMapper;
use phpOMS\Account\Account;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\RequestDestination;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Views\ViewLayout;

/**
 * News controller class.
 *
 * @category   Modules
 * @package    Modules\News
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
    const MODULE_NAME = 'News';

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
     * Providing.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var \string
     * @since 1.0.0
     */
    protected static $dependencies = [];

    /**
     * Routing elements.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $routes = [
        '^.*/backend/news/dashboard.*$' => [['dest' => '\Modules\News\Controller:viewNewsDashboard', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/news/single.*$'    => [['dest' => '\Modules\News\Controller:viewNewsArticle', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/news/archive.*$'   => [['dest' => '\Modules\News\Controller:viewNewsArchive', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/news/create.*$'    => [['dest' => '\Modules\News\Controller:viewNewsCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
    ];

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewNewsDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/News/Theme/Backend/news-dashboard');
        $view->addData('nav', $this->createNavigation(1000701001, $request, $response));

        $news     = $this->getNewsListR(20, 0, 'news.news_publish', 'DESC', $this->app->accountManager->get($request->getAccount()));
        $headline = $this->getHeadlineListR(20, 0, 'news.news_publish', 'ASC', $this->app->accountManager->get($request->getAccount()));
        $view->addData('newsList', $news);
        $view->addData('headlineList', $headline);

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewNewsArticle(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/News/Theme/Backend/news-single');
        $view->addData('nav', $this->createNavigation(1000701001, $request, $response));

        $newsArticleMapper = new NewsArticleMapper($this->app->dbPool->get());
        $article           = $newsArticleMapper->get((int) $request->getData('id'));
        $view->addData('newsList', $article);

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewNewsArchive(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/News/Theme/Backend/news-archive');
        $view->addData('nav', $this->createNavigation(1000701001, $request, $response));

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewNewsCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/News/Theme/Backend/news-create');
        $view->addData('nav', $this->createNavigation(1000701001, $request, $response));

        return $view;
    }

    /**
     * Creating news.
     *
     * @param array $articleElements Article elements
     *
     * @return NewsArticle
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function createNews(...$articleElements)
    {
        $newsArticle = new NewsArticle();
        $newsArticle->setAuthor($articleElements[0]);
        $newsArticle->setCreated($articleElements[1]);
        $newsArticle->setPublish($articleElements[2]);
        $newsArticle->setTitle($articleElements[3]);
        $newsArticle->setPlain($articleElements[4]);
        $newsArticle->setContent($articleElements[5]);
        $newsArticle->setLang($articleElements[6]);
        $newsArticle->setType($articleElements[7]);
        $newsArticle->setStatus($articleElements[8]);
        $newsArticle->setFeatured($articleElements[9]);

        $newsArticleMapper = new NewsArticleMapper($this->app->dbPool->get());

        return $newsArticleMapper->create($newsArticle);
    }

    /**
     * Get Newslists.
     *
     * @param array $articleElements Article elements
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getNewsListR(\int $limit = 50, \int $offset = 0, \string $orderBy = 'news_created', \string $ordered = 'ASC', Account $account = null)
    {
        $newsArticleMapper = new NewsArticleMapper($this->app->dbPool->get());
        $query             = $newsArticleMapper->find('news.news_id', 'news.news_author', 'news.news_publish', 'news.news_title')
                                               ->where('news.news_type', '=', 1)
                                               ->where('news.news_status', '=', 1)
                                               ->orderBy($orderBy, $ordered)
                                               ->offset($offset)
                                               ->limit($limit);

        if (isset($account)) {
            $query->where('account_permission.account_permission_account', '=', $account->getId());
        }

        return $newsArticleMapper->getAllByQuery($query);
    }

    /**
     * Get Headlinelist.
     *
     * @param array $articleElements Article elements
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHeadlineListR(\int $limit = 50, \int $offset = 0, \string $orderBy = 'news_created', \string $ordered = 'ASC', Account $account = null)
    {
        $newsArticleMapper = new NewsArticleMapper($this->app->dbPool->get());
        $query             = $newsArticleMapper->find('news.news_id', 'news.news_author', 'news.news_publish', 'news.news_title')
                                               ->where('news.news_type', '=', 0)
                                               ->where('news.news_status', '=', 1)
                                               ->orderBy($orderBy, $ordered)
                                               ->offset($offset)
                                               ->limit($limit);

        if (isset($account)) {
            $query->where('account_permission.account_permission_account', '=', $account->getId());
        }

        return $newsArticleMapper->getAllByQuery($query);
    }

    /**
     * @param int              $pageId   Page/parent Id for navigation
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function createNavigation(\int $pageId, RequestAbstract $request, ResponseAbstract $response)
    {
        $nav     = Navigation::getInstance($request, $this->app->dbPool);
        $navView = new NavigationView($this->app, $request, $response);
        $navView->setTemplate('/Modules/Navigation/Theme/Backend/mid');
        $navView->setNav($nav->getNav());
        $navView->setLanguage($request->getL11n()->language);
        $navView->setParent($pageId);

        return $navView;
    }
}
