<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Knowledgebase
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Controller;

use Modules\Knowledgebase\Models\NullWikiCategory;
use Modules\Knowledgebase\Models\WikiCategory;
use Modules\Knowledgebase\Models\WikiCategoryMapper;
use Modules\Knowledgebase\Models\WikiDoc;
use Modules\Knowledgebase\Models\WikiDocMapper;
use Modules\Knowledgebase\Models\WikiStatus;
use Modules\Tag\Models\NullTag;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * Knowledgebase class.
 *
 * @package Modules\Knowledgebase
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#79
 *  Add category management
 *  Categories cannot get managed right (created and edited). Categories need to have a language component.
 */
final class ApiController extends Controller
{
    /**
     * Api method to create a wiki entry
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
    public function apiWikiDocCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateWikiDocCreate($request))) {
            $response->set($request->getUri()->__toString(), new FormValidation($val));

            return;
        }

        $doc = $this->createWikiDocFromRequest($request, $response, $data);
        $this->createModel($request->getHeader()->getAccount(), $doc, WikiDocMapper::class, 'doc');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Wiki', 'Wiki successfully created.', $doc);
    }

    /**
     * Method to create a wiki entry from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return WikiDoc
     *
     * @since 1.0.0
     */
    public function createWikiDocFromRequest(RequestAbstract $request, ResponseAbstract $response, $data = null) : WikiDoc
    {
        $doc = new WikiDoc();
        $doc->setName((string) $request->getData('title'));
        $doc->setDoc(Markdown::parse((string) ($request->getData('plain') ?? '')));
        $doc->setDocRaw((string) ($request->getData('plain') ?? ''));
        $doc->setCategory(new NullWikiCategory((int) ($request->getData('category') ?? 1)));
        $doc->setLanguage((string) ($request->getData('language') ?? $request->getHeader()->getL11n()->getLanguage()));
        $doc->setStatus((int) ($request->getData('status') ?? WikiStatus::INACTIVE));

        if (!empty($tags = $request->getDataJson('tags'))) {
            foreach ($tags as $tag) {
                if (!isset($tag['id'])) {
                    $request->setData('title', $tag['title'], true);
                    $request->setData('color', $tag['color'], true);
                    $request->setData('language', $tag['language'], true);

                    $internalResponse = new HttpResponse();
                    $this->app->moduleManager->get('Tag')->apiTagCreate($request, $internalResponse, $data);
                    $doc->addTag($internalResponse->get($request->getUri()->__toString())['response']);
                } else {
                    $doc->addTag(new NullTag((int) $tag['id']));
                }
            }
        }

        return $doc;
    }

    /**
     * Method to validate wiki entry creation from request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateWikiDocCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['plain'] = empty($request->getData('plain')))
            || ($val['status'] = (
                $request->getData('status') !== null
                && !WikiStatus::isValidValue((int) $request->getData('status'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a wiki category
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
    public function apiWikiCategoryCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateWikiCategoryCreate($request))) {
            $response->set($request->getUri()->__toString(), new FormValidation($val));

            return;
        }

        $category = $this->createWikiCategoryFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $category, WikiCategoryMapper::class, 'category');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Category', 'Category successfully created.', $category);
    }

    /**
     * Method to create a wiki category from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return WikiCategory
     *
     * @since 1.0.0
     */
    public function createWikiCategoryFromRequest(RequestAbstract $request) : WikiCategory
    {
        $category = new WikiCategory();
        $category->setName((string) $request->getData('title'));

        if ($request->getData('path') !== null) {
            $category->setPath((string) $request->getData('path'));
        }

        if ($request->getData('parent') !== null) {
            $category->setParent(new NullWikiCategory((int) $request->getData('parent')));
        }

        return $category;
    }

    /**
     * Method to validate wiki category creation from request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateWikiCategoryCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))) {
            return $val;
        }

        return [];
    }
}
