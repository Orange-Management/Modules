<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Template') ?></h1></header>
            <div class="inner">
                <form id="reporter-template-create" action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/reporter/report/template'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iTitle"><?= $this->getText('Title') ?></label>
                        <tr><td colspan="2"><input id="iTitle" name="name" type="text" placeholder="&#xf040; P&L Reporting" required>
                        <tr><td colspan="2"><label for="iDescription"><?= $this->getText('Description') ?></label>
                        <tr><td colspan="2"><textarea id="iDescription" name="description"></textarea>
                        <tr><td colspan="2">
                                <span class="checkbox">
                                    <input id="iStandalone" name="standalone" type="checkbox" value="1">
                                    <label for="iStandalone"><?= $this->getText('Standalone') ?></label>
                                </span>
                        <tr><td colspan="2"><h2><?= $this->getText('Storage') ?></h2>
                        <tr><td colspan="2">
                                <span class="radio">
                                    <input id="iSourceDB" name="source" type="radio" value="<?= \Modules\Reporter\Models\TemplateDataType::GLOBAL_DB; ?>">
                                    <label for="iSourceDB"><?= $this->getText('CentralizedDB') ?></label>
                                </span>
                        <tr><td colspan="2">
                                <span class="radio">
                                    <input id="iSourceFile" name="source" type="radio" value="<?= \Modules\Reporter\Models\TemplateDataType::GLOBAL_FILE; ?>">
                                    <label for="iSourceFile"><?= $this->getText('CentralizedFiles') ?></label>
                                </span>
                        <tr><td colspan="2">
                                <span class="radio">
                                    <input id="iSourceOther" name="source" type="radio" value="<?= \Modules\Reporter\Models\TemplateDataType::OTHER; ?>" checked>
                                    <label for="iSourceOther"><?= $this->getText('Other') ?></label>
                                </span>
                        <tr><td colspan="2"><label for="iFile"><?= $this->getText('Files') ?></label>
                        <tr><td colspan="2"><input id="iFile" name="fileVisual" type="file" required multiple><input id="iFileHidden" name="files" type="hidden">
                        <tr><td colspan="2"><label for="iExpected"><?= $this->getText('Expected') ?></label>
                        <tr><td class="wf-100"><input id="iExpected" type="text" placeholder="&#xf15b; file.csv"><input name="expected" type="hidden"><td><button><?= $this->getText('Add', 0, 0) ?></button>
                        <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>