<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\HumanResourceManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

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
    } elseif ($extensionType === ExtensionType::DIRECTORY) {
        return 'folder-open-o';
    }

    return 'file-o';
};
