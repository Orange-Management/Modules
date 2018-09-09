<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
/**
 * @var \phpOMS\Views\View $this
 */
$templateList = \Modules\Reporter\Models\TemplateMapper::getAll();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Report'); ?></h1></header>
            <div class="inner">
                <form id="reporter-report-create" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/reporter/report/report'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iTitle"><?= $this->getHtml('Title'); ?></label>
                        <tr><td><input id="iTitle" name="name" type="text" placeholder="&#xf040; P&L Reporting 2015 December v1.0" required>
                        <tr><td><label for="iTemplate"><?= $this->getHtml('Template'); ?></label>
                        <tr><td><select id="iTemplate" name="template">
                                    <?php foreach ($templateList as $key => $value) : ?>
                                    <option value="<?= $this->printHtml($key); ?>"><?= $this->printHtml($value->getName()); ?>
                                        <?php endforeach; ?>
                                </select>
                        <tr><td><input type="submit" id="iReportCreateButton" name="reportCreateButton" value="<?= $this->getHtml('Create', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Media') ?></h1></header>

            <div class="inner">
                <form>
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iMedia"><?= $this->getHtml('Media') ?></label>
                        <tr><td>
                            <div class="ipt-wrap">
                                <div class="ipt-first"><input type="text" id="iMedia" name="mediaFile" placeholder="&#xf15b; File"></div>
                                <div class="ipt-second"><button><?= $this->getHtml('Select') ?></button></div>
                            </div>
                        <tr><td><label for="iUpload"><?= $this->getHtml('Upload') ?></label>
                        <tr><td>
                            <input type="file" id="iUpload" name="upload" form="fTask" multiple>
                            <input form="fTask" type="hidden" name="type"><td>
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>