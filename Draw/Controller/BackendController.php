<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Draw
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Draw\Controller;

use phpOMS\Model\Message\FormValidation;
use Modules\Draw\Models\DrawImage;
use Modules\Draw\Models\DrawImageMapper;
use Modules\Draw\Models\PermissionState;
use Modules\Media\Models\UploadStatus;
use phpOMS\Asset\AssetType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Html\Head;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use Modules\Media\Controller as MediaController;
use phpOMS\System\File\Local\File;
use phpOMS\Utils\ImageUtils;
use phpOMS\Views\View;
use phpOMS\Account\PermissionType;
use phpOMS\Message\Http\RequestStatusCode;

/**
 * Calendar controller class.
 *
 * @package    Modules\Draw
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class BackendController extends Controller
{

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setUpDrawEditor(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        /** @var Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::JSLATE, '/Modules/Draw/Controller.js');
        $head->addAsset(AssetType::JSLATE, '/Modules/Draw/Models/DrawType.js');
        $head->addAsset(AssetType::JSLATE, '/Modules/Draw/Models/Editor.js');
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
    public function viewDrawCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Draw/Theme/Backend/draw-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005201001, $request, $response));

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
    public function viewDrawSingle(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $draw      = DrawImageMapper::get((int) ($request->getData('id')));
        $accountId = $request->getHeader()->getAccount();

        if ($draw->getCreatedBy()->getId() !== $accountId
            && !$this->app->accountManager->get($accountId)->hasPermission(
                PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DRAW, $draw->getId())
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Draw/Theme/Backend/draw-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005201001, $request, $response));

        $view->addData('image', $draw);

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
    public function viewDrawList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Draw/Theme/Backend/draw-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1005201001, $request, $response));

        $images = DrawImageMapper::getNewest(25);
        $view->addData('images', $images);

        return $view;
    }
}
