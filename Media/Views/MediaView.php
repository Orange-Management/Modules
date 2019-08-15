<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Media\Views
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
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
 * @package    Modules\Media\Views
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class MediaView extends View
{
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

    protected function isCollectionFunction(Media $media, string $sub) : bool
    {
        return ($media->getExtension() === 'collection'
                && !\is_file($media->getPath() . $sub))
            || (\is_dir($media->getPath())
                && ($sub === null || \is_dir($media->getPath() . $sub))
        );
    }

    protected function getFileContent(string $path) : string
    {
        $output = \file_get_contents($path);
        $output = \str_replace(["\r\n", "\r"], "\n", $output);

        return $output;
    }

    protected function lineContentFunction(string $path) : array
    {
        $output = \file_get_contents($path);
        $output = \str_replace(["\r\n", "\r"], "\n", $output);

        return \explode("\n", $output);
    }

    protected function isImageFile(Media $media, string $path) : bool
    {
        return FileUtils::getExtensionType($media->getExtension()) === ExtensionType::IMAGE
            || FileUtils::getExtensionType(File::extension($path)) === ExtensionType::IMAGE;
    }

    protected function isTextFile(Media $media, string $path) : bool
    {
        $mediaExtension = FileUtils::getExtensionType($media->getExtension());
        $pathExtension  = FileUtils::getExtensionType(File::extension($path));

        return $mediaExtension === ExtensionType::TEXT || $pathExtension === ExtensionType::TEXT
            || $mediaExtension === ExtensionType::CODE || $pathExtension === ExtensionType::CODE;
    }
}
