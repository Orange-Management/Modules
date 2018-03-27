<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\News;

use Model\Message\FormValidation;
use Modules\News\Models\BadgeMapper;
use Modules\News\Models\NewsArticle;
use Modules\News\Models\NewsArticleMapper;
use Modules\News\Models\NewsStatus;
use Modules\News\Models\NewsType;
use Modules\News\Models\PermissionState;
use phpOMS\Account\Account;
use phpOMS\Account\PermissionType;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Utils\Parser\Markdown\Markdown;
use phpOMS\Views\View;

/**
 * News controller class.
 *
 * @package    Modules
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
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
    public const MODULE_PATH = __DIR__;

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
    public const MODULE_NAME = 'News';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1000600000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewNewsDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DASHBOARD)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/News/Theme/Backend/news-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000701001, $request, $response));

        $news = NewsArticleMapper::getNewest(50);
        $view->addData('news', $news);

        return $view;
    }
    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/News/Theme/Backend/dashboard-news');

        $news = NewsArticleMapper::getNewest(5);
        $view->addData('news', $news);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewNewsArticle(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $article   = NewsArticleMapper::get((int) $request->getData('id'));
        $accountId = $request->getHeader()->getAccount();

        if ($article->getCreatedBy()->getId() !== $accountId
            && !$this->app->accountManager->get($accountId)->hasPermission(
                PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::ARTICLE, $article->getId())
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/News/Theme/Backend/news-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000701001, $request, $response));
        $view->addData('news', $article);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewNewsArchive(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::ARCHIVE)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/News/Theme/Backend/news-archive');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000701001, $request, $response));

        $articles = NewsArticleMapper::getNewest(50);
        $view->addData('articles', $articles);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewNewsCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::ARTICLE)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/News/Theme/Backend/news-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000701001, $request, $response));

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * Validate news create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function validateNewsCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['plain'] = empty($request->getData('plain')))
            || ($val['lang'] = (
                $request->getData('lang') !== null
                && !ISO639x1Enum::isValidValue(strtolower((string) $request->getData('lang')))
            ))
            || ($val['type'] = (
                $request->getData('type') === null
                || !NewsType::isValidValue((int) $request->getData('type'))
            ))
            || ($val['status'] = (
                $request->getData('status') === null
                || !NewsStatus::isValidValue((int) $request->getData('status'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create news article
     * 
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     * 
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiNewsUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::ARTICLE)
        ) {
            $response->set('news_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $news = $this->updateNewsFromRequest($request);

        NewsArticleMapper::update($news);
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Group',
            'message' => 'Group successfully updated.',
            'response' => $news->jsonSerialize()
        ]);
    }

    /**
     * Method to update news from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return NewsArticle
     *
     * @since  1.0.0
     */
    private function updateNewsFromRequest(RequestAbstract $request) : NewsArticle
    {
        $newsArticle = NewsArticleMapper::get((int) $request->getData('id'));
        $newsArticle->setPublish(new \DateTime((string) ($request->getData('publish') ?? $newsArticle->getPublish()->format('Y-m-d H:i:s'))));
        $newsArticle->setTitle((string) ($request->getData('title') ?? $newsArticle->getTitle()));
        $newsArticle->setPlain($request->getData('plain') ?? $newsArticle->getPlain());
        $newsArticle->setContent(Markdown::parse((string) ($request->getData('plain') ?? $newsArticle->getPlain())));
        $newsArticle->setLanguage(strtolower((string) ($request->getData('lang') ?? $newsArticle->getLanguage())));
        $newsArticle->setType((int) ($request->getData('type') ?? $newsArticle->getType()));
        $newsArticle->setStatus((int) ($request->getData('status') ?? $newsArticle->getStatus()));
        $newsArticle->setFeatured((bool) ($request->getData('featured') ?? $newsArticle->isFeatured()));

        return $newsArticle;
    }

    /**
     * Api method to create news article
     * 
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     * 
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiNewsCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::ARTICLE)
        ) {
            $response->set('news_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateNewsCreate($request))) {
            $response->set('news_create', new FormValidation($val));

            return;
        }

        $newsArticle = $this->createNewsArticleFromRequest($request);

        NewsArticleMapper::create($newsArticle);
        $response->set($request->getUri()->__toString(), $newsArticle->jsonSerialize());
    }

    /**
     * Method to create news article from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return NewsArticle
     *
     * @since  1.0.0
     */
    private function createNewsArticleFromRequest(RequestAbstract $request) : NewsArticle
    {
        $newsArticle = new NewsArticle();
        $newsArticle->setCreatedBy($request->getHeader()->getAccount());
        $newsArticle->setPublish(new \DateTime((string) ($request->getData('publish') ?? 'now')));
        $newsArticle->setTitle((string) ($request->getData('title') ?? ''));
        $newsArticle->setPlain($request->getData('plain') ?? '');
        $newsArticle->setContent(Markdown::parse((string) ($request->getData('plain') ?? '')));
        $newsArticle->setLanguage(strtolower((string) ($request->getData('lang') ?? $request->getHeader()->getL11n()->getLanguage())));
        $newsArticle->setType((int) ($request->getData('type') ?? 1));
        $newsArticle->setStatus((int) ($request->getData('status') ?? 1));
        $newsArticle->setFeatured((bool) ($request->getData('featured') ?? true));

        return $newsArticle;
    }

    /**
     * Api method for getting a news article
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiNewsGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::ARTICLE)
        ) {
            $response->set('news_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $news = NewsArticleMapper::get((int) $request->getData('id'));
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'News',
            'message' => 'News successfully returned.',
            'response' => $news->jsonSerialize()
        ]);
    }

    /**
     * Validate badge create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function validateBadgeCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create Badge
     * 
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     * 
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiBadgeCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::BADGE)
        ) {
            $response->set('badge_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateBadgeCreate($request))) {
            $response->set('badge_create', new FormValidation($val));

            return;
        }

        $badge = $this->createBadgeFromRequest($request);

        BadgeMapper::create($badge);
        $response->set('badge', $badge->jsonSerialize());
    }

    /**
     * Method to create badge from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return NewsArticle
     *
     * @since  1.0.0
     */
    private function createBadgeFromRequest(RequestAbstract $request) : Badge
    {
        $mardkownParser = new Markdown();

        $badge = new Badge();
        $badge->setTitle((string) ($request->getData('title') ?? ''));

        return $badge;
    }

    /**
     * Get Newslists.
     *
     * @param int     $limit   News limit
     * @param int     $offset  News offset
     * @param string  $orderBy Order criteria (database table name)
     * @param string  $ordered Order type (e.g. ASC)
     * @param Account $account Accont for permission handling
     *
     * @return array
     *
     * @since  1.0.0
     */
    public function getNewsListR(int $limit = 50, int $offset = 0, string $orderBy = 'news_created', string $ordered = 'ASC', Account $account = null)
    {
        $query = NewsArticleMapper::find('news.news_id', 'news.news_author', 'news.news_publish', 'news.news_title')
            ->where('news.news_type', '=', 1)
            ->where('news.news_status', '=', 1)
            ->orderBy($orderBy, $ordered)
            ->offset($offset)
            ->limit($limit);

        return NewsArticleMapper::getAllByQuery($query);
    }

    /**
     * Get Headlinelist.
     *
     * @param int     $limit   News limit
     * @param int     $offset  News offset
     * @param string  $orderBy Order criteria (database table name)
     * @param string  $ordered Order type (e.g. ASC)
     * @param Account $account Accont for permission handling
     *
     * @return array
     *
     * @since  1.0.0
     */
    public function getHeadlineListR(int $limit = 50, int $offset = 0, string $orderBy = 'news_created', string $ordered = 'ASC', Account $account = null)
    {
        $query = NewsArticleMapper::find('news.news_id', 'news.news_author', 'news.news_publish', 'news.news_title')
            ->where('news.news_type', '=', 0)
            ->where('news.news_status', '=', 1)
            ->orderBy($orderBy, $ordered)
            ->offset($offset)
            ->limit($limit);

        return NewsArticleMapper::getAllByQuery($query);
    }

    /**
     * Api method to delete news article
     * 
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     * 
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiNewsDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::ARTICLE)
        ) {
            $response->set('news_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $news   = NewsArticleMapper::get((int) $request->getData('id'));
        $status = NewsArticleMapper::delete($news);
        
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'News',
            'message' => 'News successfully deleted.',
            'response' => $status
        ]);
    }

    /**
     * Api method to delete badge
     * 
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     * 
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiDeleteNewsBadge(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::BADGE)
        ) {
            $response->set('badge_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        BadgeMapper::delete((int) $request->getData('id'));
        $response->set('badge_delete', (int) $request->getData('id'));
    }
}
