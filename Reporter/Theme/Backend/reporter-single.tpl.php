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
            <header><h1><?= $this->getText('Reports'); ?></h1></header>

            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/reporter/template'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr>
                            <td><label for="iLang"><?= $this->getText('Language') ?></label>
                        <tr>
                            <td><select id="iLang" name="lang">
                                    <?php foreach($reportLanguage as $key => $langauge) : ?>
                                    <option value="<?= $key; ?>"<?= $key === $cLang ? ' selected' : ''; ?>><?= $langauge[':language'] ?>
                                    <?php endforeach; ?>
                                </select>
                        <tr>
                            <td><label for="iReport"><?= $this->getText('Report') ?></label>
                        <tr>
                            <td><select id="iReport" name="report">
                                </select>
                    </table>
                </form>
            </div>
        </section>

        <section class="box wf-100">
            <header><h1><?= $this->getText('Export'); ?></h1></header>

            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/reporter/template'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr>
                            <td><label for="iExport"><?= $this->getText('Export') ?></label>
                        <tr>
                            <td><select id="iExport" name="export-type">
                                    <option value="select" disabled><?= $this->getText('Select') ?>
                                    <option value="excel"<?= (!isset($tcoll['excel'])) ? ' disabled' : ''; ?>>Excel
                                    <option value="csv"<?= (!isset($tcoll['csv'])) ? ' disabled' : ''; ?>>Csv
                                    <option value="json"<?= (!isset($tcoll['json'])) ? ' disabled' : ''; ?>>Json
                                    <option value="pdf"<?= (!isset($tcoll['pdf'])) ? ' disabled' : ''; ?>>Pdf
                                </select>
                        <tr>
                            <td><input type="button" value="<?= $this->getText('Export') ?>"
                                    data-ropen="/{#lang}/api/reporter/export.php?{type=#iExport}{lang=#iLang}{QUERY}">
                    </table>
                </form>
            </div>
        </section>

        <section class="box wf-100">
            <header><h1><?= $this->getText('Info'); ?></h1></header>

            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                    <tr>
                        <th colspan="2"><?= $this->getText('Report'); ?>
                    <tr>
                        <td><?= $this->getText('Name') ?>
                        <td><?= $report->getTitle(); ?>
                    <tr>
                        <td><?= $this->getText('Creator') ?>
                        <td><?= $report->getCreatedBy(); ?>
                    <tr>
                        <td><?= $this->getText('Created') ?>
                        <td><?= $report->getCreatedAt()->format('Y-m-d'); ?>
                    <tr>
                        <th colspan="2"><?= $this->getText('Template'); ?>
                    <tr>
                        <td><?= $this->getText('Name') ?>
                        <td><?= $template->getName(); ?>
                    <tr>
                        <td><?= $this->getText('Creator') ?>
                        <td><?= $template->getCreatedBy(); ?>
                    <tr>
                        <td><?= $this->getText('Created') ?>
                        <td><?= $template->getCreatedAt()->format('Y-m-d'); ?>
                </table>
            </div>
        </section>
    </div>
</div>