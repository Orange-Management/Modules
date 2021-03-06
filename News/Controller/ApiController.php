<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\News
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\News\Controller;

use Modules\Admin\Models\NullAccount;
use Modules\News\Models\NewsArticle;
use Modules\News\Models\NewsArticleMapper;
use Modules\News\Models\NewsStatus;

use Modules\News\Models\NewsType;
use phpOMS\Account\Account;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * News controller class.
 *
 * @package Modules\News
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Validate news create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateNewsCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['plain'] = empty($request->getData('plain')))
            || ($val['lang'] = (
                $request->getData('lang') !== null
                && !ISO639x1Enum::isValidValue(\strtolower((string) $request->getData('lang')))
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
     * @since 1.0.0
     */
    public function apiNewsUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone NewsArticleMapper::get((int) $request->getData('id'));
        $new = $this->updateNewsFromRequest($request);
        $this->updateModel($request->getHeader()->getAccount(), $old, $new, NewsArticleMapper::class, 'news');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'News', 'News successfully updated', $new);
    }

    /**
     * Method to update news from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return NewsArticle
     *
     * @since 1.0.0
     */
    private function updateNewsFromRequest(RequestAbstract $request) : NewsArticle
    {
        $newsArticle = NewsArticleMapper::get((int) $request->getData('id'));
        $newsArticle->setPublish(new \DateTime((string) ($request->getData('publish') ?? $newsArticle->getPublish()->format('Y-m-d H:i:s'))));
        $newsArticle->setTitle((string) ($request->getData('title') ?? $newsArticle->getTitle()));
        $newsArticle->setPlain($request->getData('plain') ?? $newsArticle->getPlain());
        $newsArticle->setContent(Markdown::parse((string) ($request->getData('plain') ?? $newsArticle->getPlain())));
        $newsArticle->setLanguage(\strtolower((string) ($request->getData('lang') ?? $newsArticle->getLanguage())));
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
     * @since 1.0.0
     */
    public function apiNewsCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateNewsCreate($request))) {
            $response->set('news_create', new FormValidation($val));

            return;
        }

        $newsArticle = $this->createNewsArticleFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $newsArticle, NewsArticleMapper::class, 'news');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'News', 'News successfully created', $newsArticle);
    }

    /**
     * Method to create news article from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return NewsArticle
     *
     * @since 1.0.0
     */
    private function createNewsArticleFromRequest(RequestAbstract $request) : NewsArticle
    {
        $newsArticle = new NewsArticle();
        $newsArticle->setCreatedBy(new NullAccount($request->getHeader()->getAccount()));
        $newsArticle->setPublish(new \DateTime((string) ($request->getData('publish') ?? 'now')));
        $newsArticle->setTitle((string) ($request->getData('title') ?? ''));
        $newsArticle->setPlain($request->getData('plain') ?? '');
        $newsArticle->setContent(Markdown::parse((string) ($request->getData('plain') ?? '')));
        $newsArticle->setLanguage(\strtolower((string) ($request->getData('lang') ?? $request->getHeader()->getL11n()->getLanguage())));
        $newsArticle->setType((int) ($request->getData('type') ?? NewsType::ARTICLE));
        $newsArticle->setStatus((int) ($request->getData('status') ?? NewsStatus::VISIBLE));
        $newsArticle->setFeatured((bool) ($request->getData('featured') ?? true));

        return $newsArticle;
    }

    /**
     * Api method to get a news article
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiNewsGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $news = NewsArticleMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'News', 'News successfully returned', $news);
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
     * @since 1.0.0
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
     * @api
     *
     * @since 1.0.0
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
     * @since 1.0.0
     */
    public function apiNewsDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $news = NewsArticleMapper::get((int) $request->getData('id'));
        $this->deleteModel($request->getHeader()->getAccount(), $news, NewsArticleMapper::class, 'news');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'News', 'News successfully deleted', $news);
    }
}
