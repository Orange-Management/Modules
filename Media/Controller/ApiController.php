<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Media
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Media\Controller;

use Modules\Admin\Models\AccountPermission;
use Modules\Media\Models\Media;
use Modules\Media\Models\MediaMapper;
use Modules\Media\Models\PermissionState;
use Modules\Media\Models\UploadFile;
use Modules\Media\Models\UploadStatus;
use phpOMS\Account\PermissionType;
use phpOMS\Message\NotificationLevel;

use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\System\MimeType;

/**
 * Media class.
 *
 * @package Modules\Media
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Api method to find media
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
    public function apiMediaFind(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set(
            $request->getUri()->__toString(),
            \array_values(
                MediaMapper::find((string) ($request->getData('search') ?? ''))
            )
        );
    }

    /**
     * Api method to upload media file.
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
    public function apiMediaUpload(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        // todo: this is really messy because i don't use formdata object. media first get's uploaded but nothing is done with the form data
        $uploads = $this->uploadFiles(
            $request->getData('name') ?? '',
            $request->getFiles(),
            $request->getHeader()->getAccount(),
            (string) ($request->getData('path') ?? __DIR__ . '/../../../Modules/Media/Files'),
            (string) ($request->getData('virtualPath') ?? '/'),
            (string) ($request->getData('password') ?? ''),
            (string) ($request->getData('encrypt') ?? '')
        );

        $ids = [];
        foreach ($uploads as $file) {
            $ids[] = $file->getId();
        }

        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Media', 'Media successfully created.', $ids);
    }

    /**
     * @param string $name     Name
     * @param array  $files    Files
     * @param int    $account  Uploader
     * @param string $basePath Base path
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function uploadFiles(
        string $name,
        array $files,
        int $account,
        string $basePath = 'Modules/Media/Files',
        string $virtualPath = '/',
        string $password = '',
        string $encryptionKey = ''
    ) : array
    {
        $mediaCreated = [];

        if (!empty($files)) {
            $upload = new UploadFile();
            $upload->setOutputDir(self::createMediaPath($basePath));

            $status       = $upload->upload($files, $name, $encryptionKey);
            $mediaCreated = $this->createDbEntries($status, $account, $virtualPath);
        }

        return $mediaCreated;
    }

    /**
     * Create a random file path to store media files
     *
     * @param string $basePath Base path for file storage
     *
     * @return string Random path to store media files
     *
     * @since 1.0.0
     */
    public static function createMediaPath(string $basePath = 'Modules/Media/Files') : string
    {
        $rndPath = \str_pad(\dechex(\mt_rand(0, 65535)), 4, '0', \STR_PAD_LEFT);
        return $basePath . '/' . $rndPath[0] . $rndPath[1] . '/' . $rndPath[2] . $rndPath[3];
    }

    /**
     * @param array $status  Files
     * @param int   $account Uploader
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function createDbEntries(array $status, int $account, string $virtualPath = '/') : array
    {
        $mediaCreated = [];

        foreach ($status as $uFile) {
            if (($created = self::createDbEntry($uFile, $account, $virtualPath)) !== null) {
                $mediaCreated[] = $created;

                $this->app->moduleManager->get('Admin')->createAccountModelPermission(
                    new AccountPermission(
                        $account,
                        $this->app->orgId,
                        $this->app->appName,
                        self::MODULE_NAME,
                        PermissionState::MEDIA,
                        $created->getId(),
                        null,
                        PermissionType::READ | PermissionType::MODIFY | PermissionType::DELETE | PermissionType::PERMISSION
                    ),
                    $account
                );
            }
        }

        return $mediaCreated;
    }

    /**
     * Create db entry for uploaded file
     *
     * @param array  $status      Files
     * @param int    $account     Uploader
     * @param string $virtualPath Virtual path (not on the hard-drive)
     *
     * @return null|Media
     *
     * @since 1.0.0
     */
    public static function createDbEntry(array $status, int $account, string $virtualPath = '/') : ?Media
    {
        $media = null;

        if ($status['status'] === UploadStatus::OK) {
            $media = new Media();

            $media->setPath(self::normalizeDbPath($status['path']) . '/' . $status['filename']);
            $media->setName($status['name']);
            $media->setSize($status['size']);
            $media->setCreatedBy($account);
            $media->setExtension($status['extension']);
            $media->setVirtualPath($virtualPath);

            MediaMapper::create($media);
        }

        return $media;
    }

    /**
     * Normalize the file path
     *
     * @param string $path Path to the file
     *
     * @return string
     *
     * @since 1.0.0
     */
    private static function normalizeDbPath(string $path) : string
    {
        $realpath = \realpath(__DIR__ . '/../../../');

        if ($realpath === false) {
            throw new \Exception();
        }

        return \str_replace('\\', '/',
            \str_replace($realpath, '',
                \rtrim($path, '/')
            )
        );
    }

    /**
     * Api method to update media.
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
    public function apiMediaUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone MediaMapper::get((int) $request->getData('id'));
        $new = $this->updateMediaFromRequest($request);
        $this->updateModel($request, $old, $new, MediaMapper::class, 'media');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Media', 'Media successfully updated', $new);
    }

    /**
     * Method to update media from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Media
     *
     * @since 1.0.0
     */
    private function updateMediaFromRequest(RequestAbstract $request) : Media
    {
        $media = MediaMapper::get((int) $request->getData('id'));
        $media->setName((string) ($request->getData('name') ?? $media->getName()));
        $media->setVirtualPath((string) ($request->getData('virtualpath') ?? $media->getVirtualPath()));

        if ($request->getData('content') !== null) {
            \file_put_contents(
                $media->isAbsolute() ? $media->getPath() : __DIR__ . '/../../../../' . \ltrim($media->getPath(), '/'),
                $request->getData('content')
            );

            $media->setSize(\strlen($request->getData('content')));
        }

        return $media;
    }
}
