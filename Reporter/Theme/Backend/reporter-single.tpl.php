<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */
// TODO: load template in new view that doesn't get access to anything otherwise user can interact with app in bad ways
$tcoll    = $this->getData('tcoll');
$rcoll    = $this->getData('rcoll');
$cLang     = $this->getData('lang');
$template = $this->getData('template');
$report   = $this->getData('report');

/** @noinspection PhpIncludeInspection */
$reportLanguage = include __DIR__ . '/../../../../' . $tcoll['lang']->getPath();
$lang = $reportLanguage[$cLang];

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12 col-md-9">
        <div class="wf-100">
            <?php /** @noinspection PhpIncludeInspection */
            include  __DIR__ . '/../../../../' . $tcoll['template']->getPath(); ?>
        </div>
    </div>

    <div class="col-xs-12 col-md-3">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Reports') ?></h1></header>

            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/reporter/template'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr>
                            <td><label for="iLang"><?= $this->getHtml('Language'); ?></label>
                        <tr>
                            <td><select id="iLang" name="lang">
                                    <?php foreach($reportLanguage as $key => $langauge) : ?>
                                    <option value="<?= htmlspecialchars($key, ENT_COMPAT, 'utf-8'); ?>"<?= htmlspecialchars($key === $cLang ? ' selected' : '', ENT_COMPAT, 'utf-8'); ?>><?= htmlspecialchars($langauge[':language'] , ENT_COMPAT, 'utf-8'); ?>
                                    <?php endforeach; ?>
                                </select>
                        <tr>
                            <td><label for="iReport"><?= $this->getHtml('Report'); ?></label>
                        <tr>
                            <td><select id="iReport" name="report">
                                </select>
                    </table>
                </form>
            </div>
        </section>

        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Export') ?></h1></header>

            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/reporter/template'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr>
                            <td><label for="iExport"><?= $this->getHtml('Export'); ?></label>
                        <tr>
                            <td><select id="iExport" name="export-type">
                                    <option value="select" disabled><?= $this->getHtml('Select'); ?>
                                    <option value="excel"<?= htmlspecialchars((!isset($tcoll['excel'])) ? ' disabled' : '', ENT_COMPAT, 'utf-8'); ?>>Excel
                                    <option value="pdf"<?= htmlspecialchars((!isset($tcoll['pdf'])) ? ' disabled' : '', ENT_COMPAT, 'utf-8'); ?>>Pdf
                                    <option value="doc"<?= htmlspecialchars((!isset($tcoll['word'])) ? ' disabled' : '', ENT_COMPAT, 'utf-8'); ?>>Word
                                    <option value="ppt"<?= htmlspecialchars((!isset($tcoll['powerpoint'])) ? ' disabled' : '', ENT_COMPAT, 'utf-8'); ?>>Powerpoint
                                    <option value="csv"<?= htmlspecialchars((!isset($tcoll['csv'])) ? ' disabled' : '', ENT_COMPAT, 'utf-8'); ?>>Csv
                                    <option value="json"<?= htmlspecialchars((!isset($tcoll['json'])) ? ' disabled' : '', ENT_COMPAT, 'utf-8'); ?>>Json
                                    
                                </select>
                        <tr>
                            <td><input type="button" value="<?= $this->getHtml('Export'); ?>"
                                    data-ropen="/{#lang}/api/reporter/export.php?{type=#iExport}{lang=#iLang}{QUERY}">
                    </table>
                </form>
            </div>
        </section>

        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Info') ?></h1></header>

            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                    <tr>
                        <th colspan="2"><?= $this->getHtml('Report') ?>
                    <tr>
                        <td><?= $this->getHtml('Name'); ?>
                        <td><?= htmlspecialchars($report->getTitle(), ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Creator'); ?>
                        <td><?= htmlspecialchars($report->getCreatedBy()->getName1(), ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Created'); ?>
                        <td><?= $report->getCreatedAt()->format('Y-m-d'); ?>
                    <tr>
                        <th colspan="2"><?= $this->getHtml('Template') ?>
                    <tr>
                        <td><?= $this->getHtml('Name'); ?>
                        <td><?= htmlspecialchars($template->getName(), ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Creator'); ?>
                        <td><?= htmlspecialchars($template->getCreatedBy()->getName1(), ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Created'); ?>
                        <td><?= $template->getCreatedAt()->format('Y-m-d'); ?>
                </table>
            </div>
        </section>
    </div>
</div>