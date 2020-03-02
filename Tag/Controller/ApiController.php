<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tag
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tag\Controller;

use Modules\Tag\Models\Tag;

use Modules\Tag\Models\TagMapper;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;
use phpOMS\System\MimeType;

/**
 * Tag controller class.
 *
 * @package Modules\Tag
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#153
 *  Create Module
 *  Create a badge module instead of letting modules create their own internal badge/tag system.
 */
final class ApiController extends Controller
{
    /**
     * Validate tag create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateTagCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['color'] = (!empty($request->getData('color')) && !\ctype_xdigit(\ltrim($request->getData('color'), '#'))))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create tag
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
    public function apiTagUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone TagMapper::get((int) $request->getData('id'));
        $new = $this->updateTagFromRequest($request);
        $this->updateModel($request->getHeader()->getAccount(), $old, $new, TagMapper::class, 'tag');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Tag', 'Tag successfully updated', $new);
    }

    /**
     * Method to update tag from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Tag
     *
     * @since 1.0.0
     */
    private function updateTagFromRequest(RequestAbstract $request) : Tag
    {
        $tag = TagMapper::get((int) $request->getData('id'));
        $tag->setTitle((string) ($request->getData('title') ?? $tag->getTitle()));
        $tag->setColor($request->getData('color') ?? $tag->getColor());

        return $tag;
    }

    /**
     * Api method to create tag
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
    public function apiTagCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateTagCreate($request))) {
            $response->set('tag_create', new FormValidation($val));

            return;
        }

        $tag = $this->createTagFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $tag, TagMapper::class, 'tag');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Tag', 'Tag successfully created', $tag);
    }

    /**
     * Method to create tag from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Tag
     *
     * @since 1.0.0
     */
    private function createTagFromRequest(RequestAbstract $request) : Tag
    {
        $tag = new Tag();
        $tag->setTitle((string) ($request->getData('title') ?? ''));
        $tag->setColor($request->getData('color') ?? '#00000000');

        return $tag;
    }

    /**
     * Api method to get a tag
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
    public function apiTagGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $tag = TagMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Tag', 'Tag successfully returned', $tag);
    }

    /**
     * Api method to delete tag
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
    public function apiTagDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $tag = TagMapper::get((int) $request->getData('id'));
        $this->deleteModel($request->getHeader()->getAccount(), $tag, TagMapper::class, 'tag');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Tag', 'Tag successfully deleted', $tag);
    }

    /**
     * Api method to find tags
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
    public function apiTagFind(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set(
            $request->getUri()->__toString(),
            \array_values(
                TagMapper::find((string) ($request->getData('search') ?? ''))
            )
        );
    }
}
