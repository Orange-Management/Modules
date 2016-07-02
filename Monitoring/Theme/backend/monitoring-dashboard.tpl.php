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
    <header><h1><?= $this->l11n->getText('Monitoring', 'System') ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
                <tr><td><?= $this->l11n->getText('Monitoring', 'OS') ?><td><?= php_uname('s'); ?>
                <tr><td><?= $this->l11n->getText('Monitoring', 'Version') ?><td><?= php_uname('v'); ?>
                <tr><td><?= $this->l11n->getText('Monitoring', 'Release') ?><td><?= php_uname('r'); ?>
                <tr><td><?= $this->l11n->getText('Monitoring', 'RAMUsage') ?><td><?= memory_get_usage(true)/(1024*1024); ?> MB
                <tr><td><?= $this->l11n->getText('Monitoring', 'MemoryLimit') ?><td><?= ini_get('memory_limit'); ?>
                <tr><td><?= $this->l11n->getText('Monitoring', 'SystemRAM') ?><td><?= \phpOMS\System\SystemUtils::getRAM()/(1024); ?> MB
                <tr><td><?= $this->l11n->getText('Monitoring', 'CPUUsage') ?><td><?= \phpOMS\System\SystemUtils::getCpuUsage(); ?>%
                <tr><td><?= $this->l11n->getText('Monitoring', 'DiskUsage') ?><td><?= round(\phpOMS\System\File\Directory::getFolderSize(ROOT_PATH)/1000000, true); ?> MB
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->getText('Monitoring', 'Logs') ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Emergencies'] ?><td><?= $logs['emergency') ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Criticals'] ?><td><?= $logs['critical') ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Errors'] ?><td><?= $logs['error') ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Warnings'] ?><td><?= $logs['warning') ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Alerts'] ?><td><?= $logs['alert') ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Notices'] ?><td><?= $logs['notice') ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Info'] ?><td><?= $logs['info') ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Debug'] ?><td><?= $logs['debug') ?? 0; ?>
            <tr><td><?= $this->l11n->getText('Monitoring', 'Total') ?><td><?= array_sum($logs); ?>
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->getText('Monitoring', 'Penetrators') ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
            <?php foreach($penetrators as $ip => $count) : ?>
            <tr><td><?= $ip; ?><td><?= $count; ?>
            <?php endforeach; ?>
        </table>
    </div>
</section>
