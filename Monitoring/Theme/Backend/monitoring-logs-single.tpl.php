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

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Logs') ?></h1></header>

            <div class="inner">
                <table class="list w-100">
                    <tr>
                        <td><?= $this->getHtml('ID', 0, 0); ?>
                        <td><i class="fa fa-anchor"></i>
                        <td class="wf-100"><?= htmlspecialchars((int) $this->request->getData('id') ?? 0, ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Time') ?>
                        <td><i class="fa fa-clock-o"></i>
                        <td><?= htmlspecialchars($log['datetime'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Uri') ?>
                        <td><i class="fa fa-globe"></i>
                        <td><?= htmlspecialchars($log['path'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Source') ?>
                        <td><i class="fa fa-wifi"></i>
                        <td><?= htmlspecialchars($log['ip'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Level') ?>
                        <td>
                            <i class="fa fa-<?= htmlspecialchars(in_array($log['level'], ['notice', 'info', 'debug']) ? 'info-circle' : 'warning', ENT_COMPAT, 'utf-8'); ?>"></i>
                        <td><?= htmlspecialchars($log['level'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Message') ?>
                        <td><i class="fa fa-commenting"></i>
                        <td><?= htmlspecialchars($log['message'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('File') ?>
                        <td><i class="fa fa-file"></i>
                        <td><?= htmlspecialchars($log['file'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Line') ?>
                        <td><i class="fa fa-commenting"></i>
                        <td><?= htmlspecialchars($log['line'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Version') ?>
                        <td><i class="fa fa-pencil"></i>
                        <td><?= htmlspecialchars($log['version'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('OS') ?>
                        <td><i class="fa fa-laptop"></i>
                        <td><?= htmlspecialchars($log['os'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td colspan="3"><?= $this->getHtml('Backtrace') ?>
                    <tr>
                        <td colspan="3">
                            <pre><?= htmlspecialchars(json_encode($log['backtrace'], JSON_PRETTY_PRINT), ENT_COMPAT, 'utf-8'); ?></pre>
                    <tr>
                        <td colspan="3" style="padding-top: 10px"><a class="button" target="_blank"
                            href="https://gitreports.com/issue/Orange-Management/Orange-Management/?name=Guest&issue_title=<?= htmlspecialchars(urlencode($log['message']), ENT_COMPAT, 'utf-8'); ?>&details=<?= htmlspecialchars(urlencode($details), ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('Report') ?></a>
                </table>
            </div>
        </section>
    </div>
</div>
