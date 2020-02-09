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

use Modules\Media\Models\PathSettings;
use phpOMS\Uri\UriFactory;

/**
 * @todo Orange-Management/Modules#58
 *  Implement drag/drop upload
 */

/**
 * @var \phpOMS\Views\View $this
 */
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <a class="button" href="<?= UriFactory::build('{/prefix}media/list?path={?path}'); ?>">Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Upload') ?></h1></header>
            <div class="inner">
                <form method="PUT" id="media-uploader" action="<?= UriFactory::build('{/api}media'); ?>">
                    <table class="layout wf-100">
                        <tr><td><label for="iPath"><?= $this->getHtml('Path') ?></label>
                        <tr><td><input type="text" id="iPath" name="virtualPath" value="<?= $this->request->getUri()->getQuery('path') ?? ''; ?>" disabled>
                        <tr><td><label><?= $this->getHtml('Settings') ?></label>
                        <tr><td><input type="checkbox" id="iAddCollection" name="addcollection" checked><label for="iAddCollection"><?= $this->getHtml('AddToCollection') ?></label>
                        <tr><td><label for="iPathSettings"><?= $this->getHtml('PathSettings') ?></label>
                        <tr><td>
                            <select id="iPathSettings" name="pathsettings">
                                <option value="<?= PathSettings::FILE_PATH ?>" selected><?= $this->getHtml('FilePath') ?>
                                <option value="<?= PathSettings::RANDOM_PATH ?>"><?= $this->getHtml('RandomPath') ?>
                            </select>
                        <tr><td><label for="iFiles"><?= $this->getHtml('Files') ?></label>
                        <tr><td><input type="file" id="iFiles" name="files" multiple>
                        <tr><td><input type="submit" id="iMediaCreate" name="mediaCreateButton" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>