<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Helper
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);


/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="portlet">
            <form id="helper-template-create" action="<?= \phpOMS\Uri\UriFactory::build('{/api}helper/report/template'); ?>" method="post">
                <div class="portlet-head"><?= $this->getHtml('Template'); ?></div>
                <div class="portlet-body">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tbody>
                        <tr><td><label for="iTitle"><?= $this->getHtml('Title'); ?></label>
                        <tr><td><input id="iTitle" name="name" type="text" placeholder="&#xf040; P&L Reporting" required>
                        <tr><td><label for="iDescription"><?= $this->getHtml('Description'); ?></label>
                        <tr><td><?= $this->getData('editor')->render('report-editor'); ?>
                        <tr><td><?= $this->getData('editor')->getData('text')->render('report-editor', 'description', 'helper-template-create'); ?>
                        <tr><td>
                                <span class="checkbox">
                                    <input id="iStandalone" name="standalone" type="checkbox" value="1">
                                    <label for="iStandalone"><?= $this->getHtml('Standalone'); ?></label>
                                </span>
                        <tr><td><label for="iExpected"><?= $this->getHtml('Expected'); ?></label>
                        <tr><td>
                            <div class="ipt-wrap">
                                <div class="ipt-first"><input id="iExpected" type="text" placeholder="&#xf15b; file.csv"><input name="expected" type="hidden"></div>
                                <div class="ipt-second"><button><?= $this->getHtml('Add', '0', '0'); ?></button></div>
                            </div>
                    </table>
                </div>
                <div class="portlet-foot">
                    <input type="submit" id="iReportTemplateCreateButton" name="reportTemplateCreateButton" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                </div>
            </form>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <?= $this->getData('media-upload')->render('helper-template-create', '/Modules/Helper'); ?>
    </div>
</div>