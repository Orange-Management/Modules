<?php declare(strict_types=1);
/**
 * @var \phpOMS\Views\View $this
 */
$tcoll    = $this->getData('tcoll');
$rcoll    = $this->getData('rcoll');
$cLang    = $this->getData('lang');
$template = $this->getData('template');
$report   = $this->getData('report');

/** @noinspection PhpIncludeInspection */
$reportLanguage = include __DIR__ . '/../../../../' . \ltrim($tcoll['lang']->getPath(), '/');
$lang = $reportLanguage[$cLang];

require 'Worker.php';
?>

<div class="tabview tab-2">
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $lang['Overview'] ?></label></li>
            <li><label for="c-tab-2"><?= $lang['Type'] ?></label></li>
            <li><label for="c-tab-3"><?= $lang['CostObject'] ?></label></li>
            <li><label for="c-tab-4"><?= $lang['CostCenter'] ?></label></li>
            <li><label for="c-tab-5"><?= $lang['Account'] ?></label></li>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <div class="box">
                <table class="default">
                    <caption><?= $lang['Budget']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Budget']; ?>
                        <td><?= $lang['Current']; ?>
                        <td><?= $lang['Forecast']; ?>
                        <td><?= $lang['History']; ?>
                        <td><?= $lang['DiffBudget%']; ?>
                    <tbody>
                    <tr>
                        <td><?= 'EventCourseInt' ?>
                        <td><?= '?' ?>
                        <td><?= \number_format($type['A'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                        <td><?= \number_format(0.00 / $month * 12, 2) ?>
                        <td><?= \number_format(0.00, 2) ?>
                        <td><?= '100.00%' ?>
                    <tr>
                        <td><?= 'EventCourse' ?>
                        <td><?= '?' ?>
                        <td><?= \number_format(($type['K'][$fiscal_end->format('Y')]['value'] ?? 0) + ($type['R'][$fiscal_end->format('Y')]['value'] ?? 0) + ($type['V'][$fiscal_end->format('Y')]['value'] ?? 0), 2, ',', '.') ?>
                        <td><?= \number_format(0.00 / $month * 12, 2) ?>
                        <td><?= \number_format(0.00, 2) ?>
                        <td><?= '100.00%' ?>
                    <tr>
                        <td><?= 'Demo' ?>
                        <td><?= '?' ?>
                        <td><?= \number_format($type['D'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                        <td><?= \number_format(0.00 / $month * 12, 2) ?>
                        <td><?= \number_format(0.00, 2) ?>
                        <td><?= '100.00%' ?>
                    <tr>
                        <td><?= 'Briefing' ?>
                        <td><?= '?' ?>
                        <td><?= \number_format($type['E'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                        <td><?= \number_format(0.00 / $month * 12, 2) ?>
                        <td><?= \number_format(0.00, 2) ?>
                        <td><?= '100.00%' ?>
                    <tr>
                        <td><?= 'Advice' ?>
                        <td><?= '?' ?>
                        <td><?= \number_format($type['B'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                        <td><?= \number_format(0.00 / $month * 12, 2) ?>
                        <td><?= \number_format(0.00, 2) ?>
                        <td><?= '100.00%' ?>
                </table>
            </div>

            <div class="box">
                <table class="default">
                    <caption><?= $lang['CostObject']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['CostObject']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['History']; ?>
                        <td><?= $lang['Current']; ?>
                        <td><?= $lang['Forecast']; ?>
                        <td><?= $lang['Diff']; ?>
                    <tbody>
                    <?php
                    $sum_hist     = 0.0;
                    $sum_current  = 0.0;
                    $sum_forecast = 0.0;
                    foreach ($types as $key => $stype) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $stype ?>
                        <td><?= (\number_format($history = $type[$key][$fiscal_end_prev->format('Y')]['value'] ?? 0.0, 2, ',', '.')) ?>
                        <td><?= (\number_format($current = $type[$key][$fiscal_end->format('Y')]['value'] ?? 0.0, 2, ',', '.')) ?>
                        <td><?= (\number_format($forecast = ($type[$key][$fiscal_end->format('Y')]['value'] ?? 0.0) / \abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) * 12, 2, ',', '.')) ?>
                        <td><?= \number_format($history == 0 ? 0 : 100 * ($forecast - $history) / $history, 2, ',', '.') . '%' ?>
                            <?php
                            $sum_hist += $history;
                            $sum_current += $current;
                            $sum_forecast += $forecast;
                            endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($sum_hist, 2, ',', '.') ?>
                        <td><?= \number_format($sum_current, 2, ',', '.') ?>
                        <td><?= \number_format($sum_forecast, 2, ',', '.') ?>
                        <td><?= \number_format($sum_hist === 0.0 ? 0 : (100 * $sum_forecast - $sum_hist) / $sum_hist, 2, ',', '.') . '%' ?>
                </table>
            </div>

            <div class="box">
                <table class="default">
                    <caption><?= $lang['CostCenter']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['CostCenter']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['History']; ?>
                        <td><?= $lang['Current']; ?>
                        <td><?= $lang['Forecast']; ?>
                        <td><?= $lang['Diff']; ?>
                    <tbody>
                    <?php
                    $sum_hist     = 0.0;
                    $sum_current  = 0.0;
                    $sum_forecast = 0.0;
                    foreach ($costcenter as $key => $stype) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?=  $ccDef[$key] ?>
                        <td><?= (\number_format($history = $costcenter[$key][$fiscal_end_prev->format('Y')]['value'] ?? 0.0, 2, ',', '.')) ?>
                        <td><?= (\number_format($current = $costcenter[$key][$fiscal_end->format('Y')]['value'] ?? 0.0, 2, ',', '.')) ?>
                        <td><?= (\number_format($forecast = ($costcenter[$key][$fiscal_end->format('Y')]['value'] ?? 0.0) / \abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) * 12, 2, ',', '.')) ?>
                        <td><?= \number_format($history == 0 ? 0 : 100 * ($forecast - $history) / $history, 2, ',', '.') . '%' ?>
                            <?php
                            $sum_hist += $history;
                            $sum_current += $current;
                            $sum_forecast += $forecast;
                            endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($sum_hist, 2, ',', '.') ?>
                        <td><?= \number_format($sum_current, 2, ',', '.') ?>
                        <td><?= \number_format($sum_forecast, 2, ',', '.') ?>
                        <td><?= \number_format($sum_hist === 0.0 ? 0 : 100 * ($sum_forecast - $sum_hist) / $sum_hist, 2, ',', '.') . '%' ?>
                </table>
            </div>

            <div class="box">
                <table class="default">
                    <caption><?= $lang['Account']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['Account']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['History']; ?>
                        <td><?= $lang['Current']; ?>
                        <td><?= $lang['Forecast']; ?>
                        <td><?= $lang['Diff']; ?>
                    <tbody>
                    <?php
                    $sum_hist     = 0.0;
                    $sum_current  = 0.0;
                    $sum_forecast = 0.0;
                    foreach ($account as $key => $stype) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?=  $acDef[$key] ?>
                        <td><?= (\number_format($history = $account[$key][$fiscal_end_prev->format('Y')]['value'] ?? 0.0, 2, ',', '.')) ?>
                        <td><?= (\number_format($current = $account[$key][$fiscal_end->format('Y')]['value'] ?? 0.0, 2, ',', '.')) ?>
                        <td><?= (\number_format($forecast = ($account[$key][$fiscal_end->format('Y')]['value'] ?? 0.0) / \abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) * 12, 2, ',', '.')) ?>
                        <td><?= \number_format($history == 0 ? 0 : 100 * ($forecast - $history) / $history, 2, ',', '.') . '%' ?>
                            <?php
                            $sum_hist += $history;
                            $sum_current += $current;
                            $sum_forecast += $forecast;
                            endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($sum_hist, 2, ',', '.') ?>
                        <td><?= \number_format($sum_current, 2, ',', '.') ?>
                        <td><?= \number_format($sum_forecast, 2, ',', '.') ?>
                        <td><?= \number_format($sum_hist === 0.0 ? 0 : 100 * ($sum_forecast - $sum_hist) / $sum_hist, 2, ',', '.') . '%' ?>
                </table>
            </div>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <section class="box">
                <table class="default">
                    <caption><?= $lang['CostObject']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['CostObject']; ?>
                        <td><?= $lang['Date']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php
                    foreach ($costobject as $key => $co) :
                    if (\strrpos($key, 'K', -\strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td>
                        <td><?= $coDef[$key] ?? '' ?>
                        <td><?= \number_format($co[$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                            <?php endif; endforeach; ?>
                    <tr>
                        <td>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($type['K'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>

            <section class="box">
                <table class="default">
                    <caption><?= $lang['CostCenter']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['CostCenter']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php $loop = $type['K'][$fiscal_end->format('Y')]['cc'] ?? [];
                    foreach ($loop as $key => $stype) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $ccDef[$key] ?? '' ?>
                        <td><?= \number_format($stype, 2, ',', '.') ?>
                            <?php endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($type['K'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>

            <section class="box">
                <table class="default">
                    <caption><?= $lang['Account']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['Account']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php $loop = $type['K'][$fiscal_end->format('Y')]['ac'] ?? [];
                    foreach ($loop as $key => $stype) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $acDef[$key] ?? '' ?>
                        <td><?= \number_format($stype, 2, ',', '.') ?>
                            <?php endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($type['K'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>
        </div>
        <input type="radio" id="c-tab-3" name="tabular-2">
        <div class="tab">
            <section class="box">
                <table class="default">
                    <caption><?= $lang['Account']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['Account']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php $loop = $costobject['K152333'][$fiscal_end->format('Y')]['ac'] ?? [];
                    foreach ($loop as $key => $co) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $acDef[$key] ?? '' ?>
                        <td><?= \number_format($co, 2, ',', '.') ?>
                            <?php endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($costobject['K152333'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>

            <section class="box">
                <table class="default">
                    <caption><?= $lang['CostCenter']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['CostCenter']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php $loop = $costobject['K152333'][$fiscal_end->format('Y')]['cc'] ?? [];
                    foreach ($loop as $key => $co) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $ccDef[$key] ?? '' ?>
                        <td><?= \number_format($co, 2, ',', '.') ?>
                            <?php endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($costobject['K152333'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>
        </div>
        <input type="radio" id="c-tab-4" name="tabular-2">
        <div class="tab">
            <section class="box">
                <table class="default">
                    <caption><?= $lang['Account']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['Account']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php $loop = $costcenter[241][$fiscal_end->format('Y')]['ac'] ?? [];
                    foreach ($loop as $key => $ac) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $acDef[$key] ?? '' ?>
                        <td><?= \number_format($ac, 2, ',', '.') ?>
                            <?php endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($costcenter[241][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>

            <section class="box">
                <table class="default">
                    <caption><?= $lang['Type']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['Type']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php $loop = $costcenter[241][$fiscal_end->format('Y')]['type'] ?? [];
                    foreach ($loop as $key => $co) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $types[$key] ?? '' ?>
                        <td><?= \number_format($co, 2, ',', '.') ?>
                            <?php endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($costcenter[241][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>

            <section class="box">
                <table class="default">
                    <caption><?= $lang['CostObject']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['CostObject']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php $loop = $costcenter[241][$fiscal_end->format('Y')]['co'] ?? [];
                    foreach ($loop as $key => $co) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $coDef[$key] ?? '' ?>
                        <td><?= \number_format($co, 2, ',', '.') ?>
                            <?php endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($costcenter[241][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>
        </div>
        <input type="radio" id="c-tab-5" name="tabular-2">
        <div class="tab">
            <section class="box">
                <table class="default">
                    <caption><?= $lang['Type']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['Type']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php $loop = $account[4480][$fiscal_end->format('Y')]['type'] ?? [];
                    foreach ($loop as $key => $stype) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $types[$key] ?? '' ?>
                        <td><?= \number_format($stype, 2, ',', '.') ?>
                            <?php endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($account[4480][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>

            <section class="box">
                <table class="default">
                    <caption><?= $lang['CostCenter']; ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tr>
                        <td><?= $lang['CostCenter']; ?>
                        <td class="wf-100"><?= $lang['Description']; ?>
                        <td><?= $lang['Total']; ?>
                    <tbody>
                    <?php $loop = $account[4480][$fiscal_end->format('Y')]['cc'] ?? [];
                    foreach ($loop as $key => $cc) : ?>
                    <tr>
                        <td><?= $key ?>
                        <td><?= $ccDef[$key] ?? '' ?>
                        <td><?= \number_format($cc, 2, ',', '.') ?>
                            <?php endforeach; ?>
                    <tr>
                        <td>
                        <td><?= 'Total' ?>
                        <td><?= \number_format($account[4480][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.') ?>
                </table>
            </section>
        </div>
    </div>
</div>
