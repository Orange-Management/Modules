<?php

use \phpOMS\System\File\ExtensionType;

$fileIconFunction = function (int $extensionType) : string
{
    if ($extensionType === ExtensionType::CODE) {
        return 'file-code-o';
    } elseif ($extensionType === ExtensionType::TEXT) {
        return 'file-text-o';
    } elseif ($extensionType === ExtensionType::PRESENTATION) {
       return 'file-powerpoint-o';
    } elseif ($extensionType === ExtensionType::PDF) {
        return 'file-pdf-o';
    } elseif ($extensionType === ExtensionType::ARCHIVE) {
        return 'file-zip-o';
    } elseif ($extensionType === ExtensionType::AUDIO) {
        return 'file-audio-o';
    } elseif ($extensionType === ExtensionType::VIDEO) {
        return 'file-video-o';
    } elseif ($extensionType === ExtensionType::IMAGE) {
        return 'file-image-o';
    } elseif ($extensionType === ExtensionType::SPREADSHEET) {
        return 'file-excel-o';
    } elseif ($extensionType === 'collection') {
        return 'folder-open-o';
    }

    return 'file-o';
};

// todo: move all functions below here to view since they are view related and not template specific
use \phpOMS\System\File\FileUtils;
use \phpOMS\System\File\Local\File;

$filePathFunction = function ($media, string $sub) : string
{
    if (is_file($media->getPath() . $sub)
        && phpOMS\Utils\StringUtils::startsWith(
            str_replace('\\', '/', realpath($media->getPath() . $sub)), 
            $media->getPath()
        )
    ) {
        return $media->getPath() . $sub;
    }
     
    return $media->getPath();
};

$dirPathFunction = function ($media, string $sub) : string
{
    if (is_dir($media->getPath() . $sub) 
        && phpOMS\Utils\StringUtils::startsWith(
            str_replace('\\', '/', realpath($media->getPath() . $sub)), 
            $media->getPath()
        )
    ) {
        return $media->getPath() . $sub;
    }

    return $media->getPath();
};

$isCollectionFunction = function ($media, string $sub) : bool
{
    return ($media->getExtension() === 'collection'
            && !is_file($media->getPath() . $sub)) 
        || (is_dir($media->getPath())
            && ($sub === null || is_dir($media->getPath() . $sub))
    );
};

$lineContentFunction = function (string $path) : array
{
    $output = file_get_contents($path);
    $output = str_replace(["\r\n", "\r"], "\n", $output);

    return explode("\n", $output);
};

$isImageFunction = function ($media, string $path) : bool
{
    return FileUtils::getExtensionType($media->getExtension()) === ExtensionType::IMAGE 
        || FileUtils::getExtensionType(File::extension($path)) === ExtensionType::IMAGE;
};
