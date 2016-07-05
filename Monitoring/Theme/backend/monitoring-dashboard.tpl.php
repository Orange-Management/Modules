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
$logs = $this->app->logger->countLogs();
$penetrators = $this->app->logger->getHighestPerpetrator();

echo $this->getData('nav')->render(); ?>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->getText('Monitoring', 'Backend', 'System') ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
                <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'OS') ?><td><?= php_uname('s'); ?>
                <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Version') ?><td><?= php_uname('v'); ?>
                <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Release') ?><td><?= php_uname('r'); ?>
                <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'RAMUsage') ?><td><?= memory_get_usage(true)/(1024*1024); ?> MB
                <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'MemoryLimit') ?><td><?= ini_get('memory_limit'); ?>
                <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'SystemRAM') ?><td><?= \phpOMS\System\SystemUtils::getRAM()/(1024); ?> MB
                <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'CPUUsage') ?><td><?= \phpOMS\System\SystemUtils::getCpuUsage(); ?>%
                <tr><td><?= $this->l11n->getText('Monitoring', 'DiskUsage') ?><td><?= round(\phpOMS\System\File\Directory::getFolderSize(ROOT_PATH)/1000000, 'Backend', true); ?> MB
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->getText('Monitoring', 'Backend', 'Logs') ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Emergencies') ?><td><?= $logs['emergency'] ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Criticals') ?><td><?= $logs['critical'] ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Errors') ?><td><?= $logs['error'] ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Warnings') ?><td><?= $logs['warning'] ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Alerts') ?><td><?= $logs['alert'] ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Notices') ?><td><?= $logs['notice'] ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Info') ?><td><?= $logs['info'] ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Debug') ?><td><?= $logs['debug'] ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Backend', 'Total') ?><td><?= array_sum($logs); ?>
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->getText('Monitoring', 'Backend', 'Penetrators') ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
            <?php foreach($penetrators as $ip => $count) : ?>
            <tr><td><?= $ip; ?><td><?= $count; ?>
            <?php endforeach; ?>
        </table>
    </div>
</section>
