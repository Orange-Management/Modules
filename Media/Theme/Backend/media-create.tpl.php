<?php declare(strict_types=1);
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
/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Upload') ?></h1></header>
            <div class="inner">
                <form method="POST" id="media-uploader" action="">
                    <table class="layout wf-100">
                        <tr><td><label for="iFiles"><?= $this->getHtml('Files') ?></label>
                        <tr><td><input type="file" id="iFiles" name="files" multiple><input name="media" type="hidden">
                        <tr><td><input type="submit" id="iMediaCreate" name="mediaCreateButton" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>