<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Media\Views
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Media\Views;

use Modules\Media\Models\Media;
use phpOMS\System\File\ExtensionType;
use phpOMS\System\File\FileUtils;
use phpOMS\System\File\Local\File;
use phpOMS\Utils\StringUtils;

use phpOMS\Views\View;

/**
 * Media view.
 *
 * @package Modules\Media\Views
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class MediaView extends View
{
    /**
     * Get file path
     *
     * @param Media  $media Media file
     * @param string $sub   Sub path
     *
     * @return string
     *
     * @since 1.0.0
     */
    protected function filePathFunction(Media $media, string $sub) : string
    {
        if (\is_file($media->getPath() . $sub)
            && StringUtils::startsWith(
                \str_replace('\\', '/', \realpath($media->getPath() . $sub)),
                $media->getPath()
            )
        ) {
            return $media->getPath() . $sub;
        }

        return $media->getPath();
    }

    /**
     * Get directory path
     *
     * @param Media  $media Media file
     * @param string $sub   Sub path
     *
     * @return string
     *
     * @since 1.0.0
     */
    protected function dirPathFunction(Media $media, string $sub) : string
    {
        if (\is_dir($media->getPath() . $sub)
            && StringUtils::startsWith(
                \str_replace('\\', '/', \realpath($media->getPath() . $sub)),
                $media->getPath()
            )
        ) {
            return $media->getPath() . $sub;
        }

        return $media->getPath();
    }

    /**
     * Check if media file is a collection
     *
     * @param Media  $media Media file
     * @param string $sub   Sub path
     *
     * @return bool
     *
     * @since 1.0.0
     */
    protected function isCollectionFunction(Media $media, string $sub) : bool
    {
        return ($media->getExtension() === 'collection'
                && !\is_file($media->getPath() . $sub))
            || (\is_dir($media->getPath())
                && ($sub === null || \is_dir($media->getPath() . $sub))
        );
    }

    /**
     * Get file content
     *
     * @param string $path File path
     *
     * @return string
     *
     * @since 1.0.0
     */
    protected function getFileContent(string $path) : string
    {
        $output = \file_get_contents($path);
        $output = \str_replace(["\r\n", "\r"], "\n", $output);

        return $output;
    }

    /**
     * Get file content
     *
     * @param string $path File path
     *
     * @return array
     *
     * @since 1.0.0
     */
    protected function lineContentFunction(string $path) : array
    {
        $output = \file_get_contents($path);
        $output = \str_replace(["\r\n", "\r"], "\n", $output);

        return \explode("\n", $output);
    }

    /**
     * Check if media file is image file
     *
     * @param Media  $media Media file
     * @param string $path  File path
     *
     * @return bool
     *
     * @since 1.0.0
     */
    protected function isImageFile(Media $media, string $path) : bool
    {
        return FileUtils::getExtensionType($media->getExtension()) === ExtensionType::IMAGE
            || FileUtils::getExtensionType(File::extension($path)) === ExtensionType::IMAGE;
    }

    /**
     * Check if media file is text file
     *
     * @param Media  $media Media file
     * @param string $path  File path
     *
     * @return bool
     *
     * @since 1.0.0
     */
    protected function isTextFile(Media $media, string $path) : bool
    {
        $mediaExtension = FileUtils::getExtensionType($media->getExtension());
        $pathExtension  = FileUtils::getExtensionType(File::extension($path));

        return $mediaExtension === ExtensionType::TEXT || $pathExtension === ExtensionType::TEXT
            || $mediaExtension === ExtensionType::CODE || $pathExtension === ExtensionType::CODE;
    }
}
