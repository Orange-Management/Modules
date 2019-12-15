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

use Modules\Knowledgebase\Models\WikiCategory;
use Modules\Knowledgebase\Models\WikiCategoryMapper;
use Modules\Knowledgebase\Models\WikiDoc;
use Modules\Knowledgebase\Models\WikiDocMapper;
use Modules\Knowledgebase\Models\WikiStatus;

use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * Task class.
 *
 * @package Modules\Knowledgebase
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
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
            $response->set('wiki_doc_create', new FormValidation($val));

            return;
        }

        $doc = $this->createWikiDocFromRquest($request);
        WikiDocMapper::create($doc);
        $response->set('doc', $doc->jsonSerialize());
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
    public function createWikiDocFromRquest(RequestAbstract $request) : WikiDoc
    {
        $mardkownParser = new Markdown();

        $doc = new WikiDoc();
        $doc->setName((string) $request->getData('title'));
        $doc->setDoc((string) $request->getData('plain'));
        $doc->setCategory((int) $request->getData('category'));
        $doc->setStatus((int) $request->getData('status'));

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
            || ($val['category'] = empty($request->getData('category')))
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
            $response->set('wiki_category_create', new FormValidation($val));

            return;
        }

        $category = $this->createWikiCategoryFromRquest($request);
        WikiCategoryMapper::create($category);
        $response->set('category', $category->jsonSerialize());
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
    public function createWikiCategoryFromRquest(RequestAbstract $request) : WikiCategory
    {
        $mardkownParser = new Markdown();

        $category = new WikiCategory();
        $category->setName((string) $request->getData('title'));
        $category->setParent((int) $request->getData('parent'));

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
        if (($val['title'] = empty($request->getData('title')))
            || ($val['parent'] = empty($request->getData('parent')))
        ) {
            return $val;
        }

        return [];
    }
}
