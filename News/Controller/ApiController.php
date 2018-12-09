<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\News
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\News\Controller;

use phpOMS\Model\Message\FormValidation;

use Modules\News\Models\Badge;
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
use phpOMS\Message\NotificationLevel;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Utils\Parser\Markdown\Markdown;
use phpOMS\Views\View;

/**
 * News controller class.
 *
 * @package    Modules\News
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
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
        $news = $this->updateNewsFromRequest($request);
        $this->updateModel($request, $news, $news, NewsArticleMapper::class, 'news');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'News', 'News successfully updated', $news);
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
        if (!empty($val = $this->validateNewsCreate($request))) {
            $response->set('news_create', new FormValidation($val));

            return;
        }

        $newsArticle = $this->createNewsArticleFromRequest($request);
        $this->createModel($request, $newsArticle, NewsArticleMapper::class, 'news');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'News', 'News successfully created', $newsArticle);
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
        $news = NewsArticleMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'News', 'News successfully returned', $news);
    }

    /**
     * Validate badge create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
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
        if (!empty($val = $this->validateBadgeCreate($request))) {
            $response->set('badge_create', new FormValidation($val));

            return;
        }

        $badge = $this->createBadgeFromRequest($request);
        $this->createModel($request, $badge, BadgeMapper::class, 'badge');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Badge', 'Badge successfully created', $badge);
    }

    /**
     * Method to create badge from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Badge
     *
     * @since  1.0.0
     */
    private function createBadgeFromRequest(RequestAbstract $request) : Badge
    {
        $mardkownParser = new Markdown();

        $badge = new Badge();
        $badge->setName((string) ($request->getData('title') ?? ''));

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
        $news = NewsArticleMapper::get((int) $request->getData('id'));
        $this->deleteModel($request, $news, NewsArticleMapper::class, 'news');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'News', 'News successfully deleted', $news);
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
        $badge = BadgeMapper::get((int) $request->getData('id'));
        $this->deleteModel($request, $badge, BadgeMapper::class, 'badge');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Badge', 'Badge successfully deleted', $badge);
    }
}
