<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Media;

use Modules\Media\Models\Media;
use Modules\Media\Models\MediaMapper;
use Modules\Media\Models\UploadFile;
use Modules\Media\Models\UploadStatus;
use Modules\Navigation\Models\Navigation;
use Modules\Navigation\Views\NavigationView;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Views\ViewLayout;

/**
 * Media class.
 *
 * @category   Modules
 * @package    Modules\Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_NAME = 'Media';

    /**
     * Providing.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];

    /**
     * Routing elements.
     *
     * @var array
     * @since 1.0.0
     */
    protected static $routes = [
        '^.*/backend/media/list.*$'   => [['dest' => '\Modules\Media\Controller:viewMediaList', 'method' => 'GET', 'type' => ViewLayout::MAIN],],
        '^.*/backend/media/create.*$' => [
            ['dest' => '\Modules\Media\Controller:setUpFileUploader', 'method' => 'GET', 'type' => ViewLayout::NULL],
            ['dest' => '\Modules\Media\Controller:viewMediaCreate', 'method' => 'GET', 'type' => ViewLayout::MAIN],
        ],
        '^.*/backend/media/single.*$' => [['dest' => '\Modules\Media\Controller:viewMediaSingle', 'method' => 'GET', 'type' => ViewLayout::MAIN],],

        '^.*/api/media/collection.*$' => [['dest' => '\Modules\Media\Controller:apiCollectionCreate', 'method' => 'POST', 'type' => ViewLayout::MAIN],],
        '^.*/api/media$'              => [['dest' => '\Modules\Media\Controller:apiMediaUpload', 'method' => 'POST', 'type' => ViewLayout::NULL],],
        '^.*/api/media/create.*$'     => [['dest' => '\Modules\Media\Controller:apiMediaCreate', 'method' => 'POST', 'type' => ViewLayout::NULL],],
    ];

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setUpFileUploader(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $head = $response->getHead();
        $head->addAsset(AssetType::JS, $request->getUri()->getBase() . 'Modules/Media/ModuleMedia.js');
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewMediaList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Media/Theme/Backend/media-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000401001, $request, $response));

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewMediaSingle(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Media/Theme/Backend/media-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000401001, $request, $response));

        $mediaMapper = new MediaMapper($this->app->dbPool->get());
        $view->addData('media', $mediaMapper->get($request->getData('id')));

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewMediaCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Media/Theme/Backend/media-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000401001, $request, $response));

        return $view;
    }

    /**
     * Shows api content.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiMediaUpload(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $uploads = $this->uploadFiles($request->getFiles(), $request->getAccount());

        $response->set($request->__toString(), [['uploads' => $uploads, 'type' => 'UI']]);
    }

    /**
     * Shows api content.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiMediaCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        // todo: change database entry for files if has write permission
    }

    /**
     * @param array $files   Files
     * @param int   $account Uploader
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function uploadFiles(array $files, int $account) : array
    {
        $mediaCreated = [];

        if (isset($files)) {
            $upload  = new UploadFile();
            $rndPath = str_pad(dechex(rand(0, 65535)), 4, '0', STR_PAD_LEFT);
            $path    = '/Modules/Media/Files/' . $rndPath[0] . $rndPath[1] . '/' . $rndPath[2] . $rndPath[3];
            $upload->setOutputDir($path);
            $upload->setFileName(false);
            $status       = $upload->upload($files);
            $mediaCreated = $this->createDbEntries($status, $account);
        }

        return $mediaCreated;
    }

    /**
     * @param array $status  Files
     * @param int   $account Uploader
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function createDbEntries(array $status, int $account) : array
    {
        $mediaCreated = [];
        $mediaMapper  = new MediaMapper($this->app->dbPool->get());

        foreach ($status as $uFile) {
            if ($uFile['status'] === UploadStatus::OK) {
                $media = new Media();
                $media->setPath($uFile['path'] . '/' . $uFile['filename']);
                $media->setName($uFile['filename']);
                $media->setSize($uFile['size']);
                $media->setCreatedBy($account);
                $media->setCreatedAt(new \DateTime('NOW'));
                $media->setExtension($uFile['extension']);

                $mediaCreated[] = $mediaMapper->create($media);
            }
        }

        return $mediaCreated;
    }

}
