<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Editor
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Editor\Controller;

use Modules\Admin\Models\NullAccount;
use Modules\Editor\Models\EditorDoc;

use Modules\Editor\Models\EditorDocMapper;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * Calendar controller class.
 *
 * @package Modules\Editor
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#14
 *  The editor should support (maybe as extension) versioning.
 *  This doesn't have to be git or svn but at least multiple version should be able to get stored into the database.
 *  The versioning should be very straight forward and only contain a version number, date and optionally a version name.
 *  The basic save button should be just "save new version" or something similar.
 *  Based on this it should also be possible to compare different versions against each other.
 *  It should be possible to see who wrote which word, when and what it got changed to (e.g. git or microsoft track change mode).
 */
final class ApiController extends Controller
{
    /**
     * Validate document create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateEditorCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['plain'] = empty($request->getData('plain')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create document
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
    public function apiEditorCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateEditorCreate($request))) {
            $response->set('editor_create', new FormValidation($val));

            return;
        }

        $doc = $this->createDocFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $doc, EditorDocMapper::class, 'doc');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Document', 'Document successfully created', $doc);
    }

    /**
     * Method to create task from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return EditorDoc
     *
     * @since 1.0.0
     */
    private function createDocFromRequest(RequestAbstract $request) : EditorDoc
    {
        $doc = new EditorDoc();
        $doc->setTitle((string) ($request->getData('title') ?? ''));
        $doc->setPlain((string) ($request->getData('plain') ?? ''));
        $doc->setContent(Markdown::parse((string) ($request->getData('plain') ?? '')));
        $doc->setCreatedBy(new NullAccount($request->getHeader()->getAccount()));

        return $doc;
    }

    /**
     * Api method to create document
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
    public function apiEditorUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone EditorDocMapper::get((int) $request->getData('id'));
        $new = $this->updateEditorFromRequest($request);
        $this->updateModel($request->getHeader()->getAccount(), $old, $new, EditorDocMapper::class, 'doc');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Document', 'Document successfully updated', $new);
    }

    /**
     * Method to update document from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return EditorDoc
     *
     * @since 1.0.0
     */
    private function updateEditorFromRequest(RequestAbstract $request) : EditorDoc
    {
        $doc = EditorDocMapper::get((int) $request->getData('id'));
        $doc->setTitle((string) ($request->getData('title') ?? $doc->getTitle()));
        $doc->setPlain((string) ($request->getData('plain') ?? $doc->getPlain()));
        $doc->setContent(Markdown::parse((string) ($request->getData('plain') ?? $doc->getPlain())));

        return $doc;
    }

    /**
     * Api method to get a document
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
    public function apiEditorGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $doc = EditorDocMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Document', 'Document successfully returned', $doc);
    }

    /**
     * Api method to delete document
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
    public function apiEditorDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $doc = EditorDocMapper::get((int) $request->getData('id'));
        $this->deleteModel($request->getHeader()->getAccount(), $doc, EditorDocMapper::class, 'doc');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Document', 'Document successfully deleted', $doc);
    }
}
