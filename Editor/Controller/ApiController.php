<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Editor
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Editor\Controller;

use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;
use Modules\Editor\Models\EditorDoc;
use Modules\Editor\Models\EditorDocMapper;
use Modules\Editor\Models\PermissionState;

use phpOMS\Model\Message\FormValidation;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Account\PermissionType;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\NotificationLevel;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * Calendar controller class.
 *
 * @package    Modules\Editor
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class ApiController extends Controller
{

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
    public function apiEditorCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateEditorCreate($request))) {
            $response->set('editor_create', new FormValidation($val));

            return;
        }

        $doc = $this->createDocFromRequest($request);

        EditorDocMapper::create($doc);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
            'title' => 'Document',
            'message' => 'Document successfully created.',
            'response' => $doc->jsonSerialize()
        ]);
    }

    /**
     * Method to create task from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return EditorDoc
     *
     * @since  1.0.0
     */
    private function createDocFromRequest(RequestAbstract $request) : EditorDoc
    {
        $doc = new EditorDoc();
        $doc->setTitle((string) ($request->getData('title') ?? ''));
        $doc->setPlain((string) ($request->getData('plain') ?? ''));
        $doc->setContent(Markdown::parse((string) ($request->getData('plain') ?? '')));
        $doc->setCreatedBy($request->getHeader()->getAccount());

        return $doc;
    }
}
