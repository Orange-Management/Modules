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

use phpOMS\Model\Html\FormElementGenerator;
use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View $this
 */
$tcoll    = $this->getData('tcoll');
$rcoll    = $this->getData('rcoll');
$cLang    = $this->getData('lang');
$template = $this->getData('template');
$report   = $this->getData('report');

/** @noinspection PhpIncludeInspection */
$reportLanguage = isset($tcoll['lang']) ? include __DIR__ . '/../../../../' . \ltrim($tcoll['lang']->getPath(), '/') : [];
$lang           = $reportLanguage[$cLang] ?? [];
$settings       = isset($tcoll['cfg']) ? \json_decode(\file_get_contents(__DIR__ . '/../../../../' . \ltrim($tcoll['cfg']->getPath(), '/')), true) : [];

echo $this->getData('nav')->render(); ?>
<div class="row" style="height: calc(100% - 85px);">
    <div class="col-xs-12 col-md-9">
        <iframe src="<?= UriFactory::build('{/api}helper/report/export/?id=' . $template->getId()); ?>&u=<?=  $this->getData('unit'); ?>" allowfullscreen></iframe>
    </div>
    <div class="col-xs-12 col-md-3">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Reports') ?></h1></header>

            <div class="inner">
                <form action="<?= UriFactory::build('{/api}helper/template'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr>
                            <td><label for="iLang"><?= $this->getHtml('Language'); ?></label>
                        <tr>
                            <td><select id="iLang" name="lang" data-action='[{"listener": "change", "action": [{"key": 1, "type": "redirect", "uri": "{%}&lang={#iLang}", "target": "self"}]}]'>
                                    <?php foreach ($reportLanguage as $key => $language) : ?>
                                    <option value="<?= $this->printHtml($key); ?>"<?= $this->printHtml($key === $cLang ? ' selected' : ''); ?>><?= $this->printHtml($language[':language']); ?>
                                    <?php endforeach; ?>
                                </select>
                        <?php if (!$template->isStandalone()) : ?><tr>
                            <td><label for="iReport"><?= $this->getHtml('Report'); ?></label>
                        <tr>
                            <td><select id="iReport" name="report">
                                </select>
                        <?php endif; ?>
                    </table>
                </form>
            </div>
        </section>

        <?php if (isset($tcoll['excel']) || isset($tcoll['pdf']) || isset($tcoll['word']) || isset($tcoll['powerpoint']) || isset($tcoll['csv']) || isset($tcoll['json'])) : ?>
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Export') ?></h1></header>

            <div class="inner">
                <form>
                    <table class="layout wf-100">
                        <tbody>
                        <tr>
                            <td><label for="iExport"><?= $this->getHtml('Export'); ?></label>
                        <tr>
                            <td><select id="iExport" name="export-type">
                                    <option value="select" disabled><?= $this->getHtml('Select'); ?>
                                    <option value="htm"><?= $this->getHtml('Print'); ?>
                                    <option value="excel"<?= $this->printHtml((!isset($tcoll['excel'])) ? ' disabled' : ''); ?>>Excel
                                    <option value="pdf"<?= $this->printHtml((!isset($tcoll['pdf'])) ? ' disabled' : ''); ?>>Pdf
                                    <option value="doc"<?= $this->printHtml((!isset($tcoll['word'])) ? ' disabled' : ''); ?>>Word
                                    <option value="ppt"<?= $this->printHtml((!isset($tcoll['powerpoint'])) ? ' disabled' : ''); ?>>Powerpoint
                                    <option value="csv"<?= $this->printHtml((!isset($tcoll['csv'])) ? ' disabled' : ''); ?>>Csv
                                    <option value="json"<?= $this->printHtml((!isset($tcoll['json'])) ? ' disabled' : ''); ?>>Json

                                </select>
                        <tr>
                            <td><a target="_blank" class="button" href="<?= UriFactory::build('{/api}helper/report/export?{?}'); ?>&type={#iExport}&lang={#iLang}{#iUiSettings}"><?= $this->getHtml('Export'); ?></a>
                    </table>
                </form>
            </div>
        </section>
        <?php endif; ?>

        <?php if (!empty($settings)) : ?>
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Settings') ?></h1></header>

            <div class="inner">
                <form id="iUiSettings">
                    <table class="layout wf-100">
                        <tbody>
                        <?php foreach ($settings as $element) : ?>
                        <tr>
                            <td><?= FormElementGenerator::generate($element, $this->request->getData($element['attributes']['name'] ?? '')); ?>
                        <?php endforeach; ?>
                        <tr>
                            <td><a class="button" href="<?= UriFactory::build('{%}') ;?>&type={#iExport}&lang={#iLang}{#iUiSettings}"><?= $this->getHtml('Load'); ?></a>
                    </table>
                </form>
            </div>
        </section>
        <?php endif; ?>

        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Info') ?></h1></header>

            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                    <?php if (!$template->isStandalone() && !($report instanceof \Modules\Helper\Models\NullReport)) : ?>
                    <tr>
                        <th colspan="2"><?= $this->getHtml('Report') ?>
                    <tr>
                        <td><?= $this->getHtml('Name'); ?>
                        <td><?= $this->printHtml($report->getTitle()); ?>
                    <tr>
                        <td><?= $this->getHtml('Creator'); ?>
                        <td><?= $this->printHtml($report->getCreatedBy()->getName1()); ?>
                    <tr>
                        <td><?= $this->getHtml('Created'); ?>
                        <td><?= $report->getCreatedAt()->format('Y-m-d'); ?>
                    <?php endif; ?>
                    <tr>
                        <th colspan="2"><?= $this->getHtml('Template') ?>
                    <tr>
                        <td><?= $this->getHtml('Name'); ?>
                        <td><?= $this->printHtml($template->getName()); ?>
                    <tr>
                        <td><?= $this->getHtml('Creator'); ?>
                        <td><?= $this->printHtml($template->getCreatedBy()->getName1()); ?>
                    <tr>
                        <td><?= $this->getHtml('Created'); ?>
                        <td><?= $template->getCreatedAt()->format('Y-m-d'); ?>
                </table>
            </div>
        </section>
    </div>
</div>