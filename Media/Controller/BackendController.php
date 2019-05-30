<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Media
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Media\Controller;

use Modules\Media\Models\CollectionMapper;
use Modules\Media\Models\Media;
use Modules\Media\Models\MediaMapper;
use Modules\Media\Views\MediaView;

use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Media class.
 *
 * @package    Modules\Media
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class BackendController extends Controller
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
    public const MODULE_NAME = 'Media';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1000400000;

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
    protected static $dependencies = [];

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
    public static function setUpFileUploader(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::JSLATE, 'Modules/Media/Controller.js', ['type' => 'module']);
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewMediaList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Media/Theme/Backend/media-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000401001, $request, $response));

        $media = MediaMapper::getByVirtualPath('/');
        $view->addData('media', $media);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewMediaSingle(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new MediaView($this->app, $request, $response);
        $view->setTemplate('/Modules/Media/Theme/Backend/media-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000401001, $request, $response));

        $media = MediaMapper::get((int) $request->getData('id'));
        if ($media->getExtension() === 'collection') {
            //$media = CollectionMapper::get($media->getId());
            $media = MediaMapper::getByVirtualPath(
                $media->getVirtualPath() . ($media->getVirtualPath() !== '/' ? '/' : '') . $media->getName()
            );

            $view->setTemplate('/Modules/Media/Theme/Backend/media-list');

            // todo: currently the $media list only contains elements from the path but it should also include all
            // the collection elements which might be the same but maybe some are not in the same virtualPath!!!
            // the *unique* merge should be done through the ids!
        }

        $view->addData('media', $media);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewMediaCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Media/Theme/Backend/media-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000401001, $request, $response));

        return $view;
    }
}
