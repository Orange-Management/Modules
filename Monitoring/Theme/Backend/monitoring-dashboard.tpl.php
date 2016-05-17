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
    <header><h1><?= $this->l11n->lang['Monitoring']['System'] ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
                <tr><td><?= $this->l11n->lang['Monitoring']['OS'] ?><td><?= php_uname('s'); ?>
                <tr><td><?= $this->l11n->lang['Monitoring']['Version'] ?><td><?= php_uname('v'); ?>
                <tr><td><?= $this->l11n->lang['Monitoring']['Release'] ?><td><?= php_uname('r'); ?>
                <tr><td><?= $this->l11n->lang['Monitoring']['RAMUsage'] ?><td><?= memory_get_usage(true)/(1024*1024); ?> MB
                <tr><td><?= $this->l11n->lang['Monitoring']['MemoryLimit'] ?><td><?= ini_get('memory_limit'); ?>
                <tr><td><?= $this->l11n->lang['Monitoring']['SystemRAM'] ?><td><?= \phpOMS\Utils\SystemUtils::getRAM()/(1024); ?> MB
                <tr><td><?= $this->l11n->lang['Monitoring']['CPUUsage'] ?><td><?= \phpOMS\Utils\SystemUtils::getCpuUsage(); ?>%
                <tr><td><?= $this->l11n->lang['Monitoring']['DiskUsage'] ?><td><?= round(\phpOMS\Utils\SystemUtils::getFolderSize(ROOT_PATH)/1000000, 0); ?> MB
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->lang['Monitoring']['Logs'] ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
            <tr><td><?= $this->l11n->lang['Monitoring']['Emergencies'] ?><td><?= $logs['emergency'] ?? 0; ?>
            <tr><td><?= $this->l11n->lang['Monitoring']['Criticals'] ?><td><?= $logs['critical'] ?? 0; ?>
            <tr><td><?= $this->l11n->lang['Monitoring']['Errors'] ?><td><?= $logs['error'] ?? 0; ?>
            <tr><td><?= $this->l11n->lang['Monitoring']['Warnings'] ?><td><?= $logs['warning'] ?? 0; ?>
            <tr><td><?= $this->l11n->lang['Monitoring']['Alerts'] ?><td><?= $logs['alert'] ?? 0; ?>
            <tr><td><?= $this->l11n->lang['Monitoring']['Notices'] ?><td><?= $logs['notice'] ?? 0; ?>
            <tr><td><?= $this->l11n->lang['Monitoring']['Info'] ?><td><?= $logs['info'] ?? 0; ?>
            <tr><td><?= $this->l11n->lang['Monitoring']['Debug'] ?><td><?= $logs['debug'] ?? 0; ?>
            <tr><td><?= $this->l11n->lang['Monitoring']['Total'] ?><td><?= array_sum($logs); ?>
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->lang['Monitoring']['Penetrators'] ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tbody>
            <?php foreach($penetrators as $ip => $count) : ?>
            <tr><td><?= $ip; ?><td><?= $count; ?>
            <?php endforeach; ?>
        </table>
    </div>
</section>
