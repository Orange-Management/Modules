<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
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
// TODO: load template in new view that doesn't get access to anything otherwise user can interact with app in bad ways
$tcoll    = $this->getData('tcoll');
$rcoll    = $this->getData('rcoll');
$lang     = $this->getData('lang');
$template = $this->getData('template');
$report   = $this->getData('report');

/** @noinspection PhpIncludeInspection */
include ROOT_PATH . '/' . $tcoll['lang']->getPath();

$lang = $reportLanguage[$lang];

echo $this->getData('nav')->render(); ?>
<div class="wf-75 floatLeft">
    <?php /** @noinspection PhpIncludeInspection */
    include $tcoll['template']->getPath(); ?>
</div>

<div class="wf-25 floatLeft">
    <section class="box w-100">
        <h1><?= $this->l11n->lang['Reporter']['Reports']; ?></h1>

        <div class="inner">
            <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/reporter/template'); ?>" method="post">
                <table class="layout wf-100">
                    <tbody>
                    <tr>
                        <td><label for="iLang"><?= $this->l11n->lang['Reporter']['Language'] ?></label>
                    <tr>
                        <td><select id="iLang" name="lang">
                                <?php foreach($reportLanguage as $key => $langauge) : ?>
                                <option value="<?= $key; ?>"<?= $langauge[':language'] === $lang[':language'] ? ' selected' : ''; ?>><?= $langauge[':language'] ?>
                                <?php endforeach; ?>
                            </select>
                    <tr>
                        <td><label for="iReport"><?= $this->l11n->lang['Reporter']['Report'] ?></label>
                    <tr>
                        <td><select id="iReport" name="report">
                            </select>
                </table>
            </form>
        </div>
    </section>

    <section class="box w-100">
        <h1><?= $this->l11n->lang['Reporter']['Export']; ?></h1>

        <div class="inner">
            <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/reporter/template'); ?>" method="post">
                <table class="layout wf-100">
                    <tbody>
                    <tr>
                        <td><label for="iExport"><?= $this->l11n->lang['Reporter']['Export'] ?></label>
                    <tr>
                        <td><select id="iExport" name="export-type">
                                <option value="select" disabled><?= $this->l11n->lang[0]['Select'] ?>
                                <option value="excel"<?= (!isset($tcoll['excel'])) ? ' disabled' : ''; ?>>Excel
                                <option value="csv"<?= (!isset($tcoll['csv'])) ? ' disabled' : ''; ?>>Csv
                                <option value="json"<?= (!isset($tcoll['json'])) ? ' disabled' : ''; ?>>Json
                                <option value="pdf"<?= (!isset($tcoll['pdf'])) ? ' disabled' : ''; ?>>Pdf
                            </select>
                    <tr>
                        <td><input type="button" value="<?= $this->l11n->lang['Reporter']['Export'] ?>"
                                   data-ropen="/{#lang}/api/reporter/export.php?{type=#iExport}{lang=#iLang}{QUERY}">
                </table>
            </form>
        </div>
    </section>

    <section class="box w-100">
        <h1><?= $this->l11n->lang['Reporter']['Info']; ?></h1>

        <div class="inner">
            <table class="list wf-100">
                <tbody>
                <tr>
                    <th colspan="2"><?= $this->l11n->lang['Reporter']['Report']; ?>
                <tr>
                    <td><?= $this->l11n->lang['Reporter']['Name'] ?>
                    <td><?= $report->getTitle(); ?>
                <tr>
                    <td><?= $this->l11n->lang['Reporter']['Creator'] ?>
                    <td><?= $report->getCreatedBy(); ?>
                <tr>
                    <td><?= $this->l11n->lang['Reporter']['Created'] ?>
                    <td><?= $report->getCreatedAt()->format('Y-m-d'); ?>
                <tr>
                    <th colspan="2"><?= $this->l11n->lang['Reporter']['Template']; ?>
                <tr>
                    <td><?= $this->l11n->lang['Reporter']['Name'] ?>
                    <td><?= $template->getName(); ?>
                <tr>
                    <td><?= $this->l11n->lang['Reporter']['Creator'] ?>
                    <td><?= $template->getCreatedBy(); ?>
                <tr>
                    <td><?= $this->l11n->lang['Reporter']['Created'] ?>
                    <td><?= $template->getCreatedAt()->format('Y-m-d'); ?>
            </table>
        </div>
    </section>
</div>
