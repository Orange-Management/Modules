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

use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View $this
 */
$templateList = \Modules\Helper\Models\TemplateMapper::getAll();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="portlet">
            <form id="helper-report-create" action="<?= UriFactory::build('{/api}helper/report/report'); ?>" method="post">
                <div class="portlet-head"><?= $this->getHtml('Report'); ?></div>
                <div class="portlet-body">
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
                    </table>
                </div>
                <div class="portlet-foot">
                    <input type="submit" id="iReportCreateButton" name="reportCreateButton" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                </div>
            </form>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <?= $this->getData('media-upload')->render('helper-report-create'); ?>
    </div>
</div>
