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

$log              = $this->app->logger->getByLine((int) $this->request->getData('id') ?? 1);
$temp             = trim($log['backtrace']);
$log['backtrace'] = json_decode($temp, true);

$details = '* Uri: `' . trim($log['path']) . "`\n"
    . '* Level: `' . trim($log['level']) . "`\n"
    . '* Message: `' . trim($log['message']) . "`\n"
    . '* File: `' . trim($log['file']) . "`\n"
    . '* Line: `' . trim($log['line']) . "`\n"
    . '* Version: `' . trim($log['version']) . "`\n"
    . '* OS: `' . trim($log['os']) . "`\n\n"
    . "Backtrace: \n\n```\n" . json_encode($log['backtrace'], JSON_PRETTY_PRINT);

echo $this->getData('nav')->render(); ?>

<section class="box w-100">
    <header><h1><?= $this->l11n->getText('Monitoring', 'Backend', 'Logs'); ?></h1></header>

    <div class="inner">
        <table class="list w-100">
            <tr>
                <td><?= $this->l11n->getText(0, 'Backend', 'ID'); ?>
                <td><i class="fa fa-anchor"></i>
                <td class="wf-100"><?= (int) $this->request->getData('id') ?? 0; ?>
            <tr>
                <td><?= $this->l11n->getText('Monitoring', 'Backend', 'Time'); ?>
                <td><i class="fa fa-clock-o"></i>
                <td><?= $log['datetime']; ?>
            <tr>
                <td><?= $this->l11n->getText('Monitoring', 'Backend', 'Uri'); ?>
                <td><i class="fa fa-globe"></i>
                <td><?= $log['path']; ?>
            <tr>
                <td><?= $this->l11n->getText('Monitoring', 'Backend', 'Source'); ?>
                <td><i class="fa fa-wifi"></i>
                <td><?= $log['ip']; ?>
            <tr>
                <td><?= $this->l11n->getText('Monitoring', 'Backend', 'Level'); ?>
                <td>
                    <i class="fa fa-<?= in_array($log['level'], ['notice', 'info', 'debug']) ? 'info-circle' : 'warning'; ?>"></i>
                <td><?= $log['level']; ?>
            <tr>
                <td><?= $this->l11n->getText('Monitoring', 'Backend', 'Message'); ?>
                <td><i class="fa fa-commenting"></i>
                <td><?= $log['message']; ?>
            <tr>
                <td><?= $this->l11n->getText('Monitoring', 'Backend', 'File'); ?>
                <td><i class="fa fa-file"></i>
                <td><?= $log['file']; ?>
            <tr>
                <td><?= $this->l11n->getText('Monitoring', 'Backend', 'Line'); ?>
                <td><i class="fa fa-commenting"></i>
                <td><?= $log['line']; ?>
            <tr>
                <td><?= $this->l11n->getText('Monitoring', 'Backend', 'Version'); ?>
                <td><i class="fa fa-pencil"></i>
                <td><?= $log['version']; ?>
            <tr>
                <td><?= $this->l11n->getText('Monitoring', 'Backend', 'OS'); ?>
                <td><i class="fa fa-laptop"></i>
                <td><?= $log['os']; ?>
            <tr>
                <td colspan="3"><?= $this->l11n->getText('Monitoring', 'Backend', 'Backtrace'); ?>
            <tr>
                <td colspan="3">
                    <pre><?= json_encode($log['backtrace'], JSON_PRETTY_PRINT); ?></pre>
            <tr>
                <td colspan="3" style="padding-top: 10px"><a class="button" target="_blank"
                       href="https://gitreports.com/issue/Orange-Management/Orange-Management/?name=Guest&issue_title=<?= urlencode($log['message']); ?>&details=<?= urlencode($details); ?>"><?= $this->l11n->getText('Monitoring', 'Backend', 'Report'); ?></a>
        </table>
    </div>
</section>
