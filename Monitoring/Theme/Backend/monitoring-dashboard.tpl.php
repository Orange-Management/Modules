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
$logs = $this->app->logger->countLogs();
$penetrators = $this->app->logger->getHighestPerpetrator();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('System'); ?></h1></header>
            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                        <tr><td><?= $this->getHtml('OS'); ?><td><?= htmlspecialchars(php_uname('s'), ENT_COMPAT, 'utf-8'); ?>
                        <tr><td><?= $this->getHtml('Version'); ?><td><?= htmlspecialchars(php_uname('v'), ENT_COMPAT, 'utf-8'); ?>
                        <tr><td><?= $this->getHtml('Release'); ?><td><?= htmlspecialchars(php_uname('r'), ENT_COMPAT, 'utf-8'); ?>
                        <tr><td><?= $this->getHtml('RAMUsage'); ?><td><?= htmlspecialchars(memory_get_usage(true)/(1024*1024), ENT_COMPAT, 'utf-8'); ?> MB
                        <tr><td><?= $this->getHtml('MemoryLimit'); ?><td><?= htmlspecialchars(ini_get('memory_limit'), ENT_COMPAT, 'utf-8'); ?>
                        <tr><td><?= $this->getHtml('SystemRAM'); ?><td><?= htmlspecialchars(\phpOMS\System\SystemUtils::getRAM()/(1024), ENT_COMPAT, 'utf-8'); ?> MB
                        <tr><td><?= $this->getHtml('CPUUsage'); ?><td><?= htmlspecialchars(\phpOMS\System\SystemUtils::getCpuUsage(), ENT_COMPAT, 'utf-8'); ?>%
                </table>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Logs'); ?></h1></header>
            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                    <tr><td><?= $this->getHtml('Emergencies'); ?><td><?= htmlspecialchars($logs['emergency'] ?? 0, ENT_COMPAT, 'utf-8'); ?>
                    <tr><td><?= $this->getHtml('Criticals'); ?><td><?= htmlspecialchars($logs['critical'] ?? 0, ENT_COMPAT, 'utf-8'); ?>
                    <tr><td><?= $this->getHtml('Errors'); ?><td><?= htmlspecialchars($logs['error'] ?? 0, ENT_COMPAT, 'utf-8'); ?>
                    <tr><td><?= $this->getHtml('Warnings'); ?><td><?= htmlspecialchars($logs['warning'] ?? 0, ENT_COMPAT, 'utf-8'); ?>
                    <tr><td><?= $this->getHtml('Alerts'); ?><td><?= htmlspecialchars($logs['alert'] ?? 0, ENT_COMPAT, 'utf-8'); ?>
                    <tr><td><?= $this->getHtml('Notices'); ?><td><?= htmlspecialchars($logs['notice'] ?? 0, ENT_COMPAT, 'utf-8'); ?>
                    <tr><td><?= $this->getHtml('Info'); ?><td><?= htmlspecialchars($logs['info'] ?? 0, ENT_COMPAT, 'utf-8'); ?>
                    <tr><td><?= $this->getHtml('Debug'); ?><td><?= htmlspecialchars($logs['debug'] ?? 0, ENT_COMPAT, 'utf-8'); ?>
                    <tr><td><?= $this->getHtml('Total'); ?><td><?= htmlspecialchars(array_sum($logs), ENT_COMPAT, 'utf-8'); ?>
                </table>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Penetrators'); ?></h1></header>
            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                    <?php foreach($penetrators as $ip => $count) : ?>
                    <tr><td><?= htmlspecialchars($ip, ENT_COMPAT, 'utf-8'); ?><td><?= htmlspecialchars($count, ENT_COMPAT, 'utf-8'); ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </section>
    </div>
</div>