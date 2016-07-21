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
use phpOMS\Asset\AssetType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Html\Head;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\System\MimeType;
use phpOMS\Views\View;

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
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function setUpFileUploader(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        /** @var Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::JSLATE, $request->getUri()->getBase() . 'Modules/Media/Models/Upload.js');
        $head->addAsset(AssetType::JSLATE, $request->getUri()->getBase() . 'Modules/Media/Controller.js');
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
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
     * @return \Serializable
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewMediaSingle(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Media/Theme/Backend/media-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000401001, $request, $response));

        $view->addData('media', MediaMapper::get($request->getData('id')));

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
        $uploads = $this->uploadFiles($request->getFiles(), $request->getAccount(), $request->getData('path') ?? '/Modules/Media/Files');

        $response->getHeader()->set('Content-Type', MimeType::M_JSON . '; charset=utf-8', true);
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
     * @param array  $files    Files
     * @param int    $account  Uploader
     * @param string $basePath Base path
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function uploadFiles(array $files, int $account, string $basePath = '/Modules/Media/Files') : array
    {
        $mediaCreated = [];

        if (!empty($files)) {
            $upload  = new UploadFile();
            $rndPath = str_pad(dechex(rand(0, 65535)), 4, '0', STR_PAD_LEFT);
            $path    = '/' . trim($basePath, '/\\.') . '/' . $rndPath[0] . $rndPath[1] . '/' . $rndPath[2] . $rndPath[3];
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

        foreach ($status as $uFile) {
            if ($uFile['status'] === UploadStatus::OK) {
                $media = new Media();
                $media->setPath(trim($uFile['path'], '/') . '/' . $uFile['filename']);
                $media->setName($uFile['filename']);
                $media->setSize($uFile['size']);
                $media->setCreatedBy($account);
                $media->setCreatedAt(new \DateTime('NOW'));
                $media->setExtension($uFile['extension']);

                $mediaCreated[] = MediaMapper::create($media);
            }
        }

        return $mediaCreated;
    }

}
