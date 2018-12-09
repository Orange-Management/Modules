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

use Modules\Knowledgebase\Models\WikiBadge;
use Modules\Knowledgebase\Models\WikiCategory;
use Modules\Knowledgebase\Models\WikiCategoryMapper;
use Modules\Knowledgebase\Models\WikiDoc;
use Modules\Knowledgebase\Models\WikiDocMapper;

use Modules\Knowledgebase\Models\WikiStatus;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Task class.
 *
 * @package    Modules\Knowledgebase
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class ApiController extends Controller
{

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

    public function createWikiCategoryFromRquest(RequestAbstract $request) : WikiCategory
    {
        $mardkownParser = new Markdown();

        $category = new WikiCategory();
        $category->setName((string) $request->getData('title'));
        $category->setParent((int) $request->getData('parent'));

        return $category;
    }

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

    public function apiWikiBadgeCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateWikiBadgeCreate($request))) {
            $response->set('wiki_badge_create', new FormValidation($val));

            return;
        }

        $badge = $this->createWikiBadgeFromRquest($request);
        WikiBadgeMapper::create($badge);
        $response->set('badge', $badge->jsonSerialize());
    }

    public function createWikiBadgeFromRquest(RequestAbstract $request) : WikiBadge
    {
        $mardkownParser = new Markdown();

        $badge = new WikiBadge();
        $badge->setName((string) $request->getData('title'));

        return $badge;
    }

    private function validateWikiBadgeCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
        ) {
            return $val;
        }

        return [];
    }
}
