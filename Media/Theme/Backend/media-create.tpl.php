<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
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
/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render(); ?>
<section class="box w-50">
    <header><h1><?= $this->getText('Upload'); ?></h1></header>
    <div class="inner">
        <form method="POST" id="media-uploader" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/media'); ?>">
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->getText('Name'); ?></label>
                <tr><td><input type="text" id="iName" name="name" placeholder="&#xf040;">
                <tr><td><label for="iFiles"><?= $this->getText('Files'); ?></label>
                <tr><td><input type="file" id="iFiles" name="files" multiple><input name="media" type="hidden">
                <tr><td><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
            </table>
        </form>
    </div>
</section>
