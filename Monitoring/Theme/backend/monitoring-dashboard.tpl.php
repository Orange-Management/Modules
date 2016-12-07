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
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
$logs = $this->app->logger->countLogs();
$penetrators = $this->app->logger->getHighestPerpetrator();

echo $this->getData('nav')->render(); ?>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('System') ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
                <tr><td><?= $this->getText('OS') ?><td><?= php_uname('s'); ?>
                <tr><td><?= $this->getText('Version') ?><td><?= php_uname('v'); ?>
                <tr><td><?= $this->getText('Release') ?><td><?= php_uname('r'); ?>
                <tr><td><?= $this->getText('RAMUsage') ?><td><?= memory_get_usage(true)/(1024*1024); ?> MB
                <tr><td><?= $this->getText('MemoryLimit') ?><td><?= ini_get('memory_limit'); ?>
                <tr><td><?= $this->getText('SystemRAM') ?><td><?= \phpOMS\System\SystemUtils::getRAM()/(1024); ?> MB
                <tr><td><?= $this->getText('CPUUsage') ?><td><?= \phpOMS\System\SystemUtils::getCpuUsage(); ?>%
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Logs') ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
            <tr><td><?= $this->getText('Emergencies') ?><td><?= $logs['emergency'] ?? 0; ?>
            <tr><td><?= $this->getText('Criticals') ?><td><?= $logs['critical'] ?? 0; ?>
            <tr><td><?= $this->getText('Errors') ?><td><?= $logs['error'] ?? 0; ?>
            <tr><td><?= $this->getText('Warnings') ?><td><?= $logs['warning'] ?? 0; ?>
            <tr><td><?= $this->getText('Alerts') ?><td><?= $logs['alert'] ?? 0; ?>
            <tr><td><?= $this->getText('Notices') ?><td><?= $logs['notice'] ?? 0; ?>
            <tr><td><?= $this->getText('Info') ?><td><?= $logs['info'] ?? 0; ?>
            <tr><td><?= $this->getText('Debug') ?><td><?= $logs['debug'] ?? 0; ?>
            <tr><td><?= $this->getText('Total') ?><td><?= array_sum($logs); ?>
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Penetrators') ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
            <?php foreach($penetrators as $ip => $count) : ?>
            <tr><td><?= $ip; ?><td><?= $count; ?>
            <?php endforeach; ?>
        </table>
    </div>
</section>
