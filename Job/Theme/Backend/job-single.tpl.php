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
 * @var \phpOMS\Views\View         $this
 */
$job      = $this->getData('job');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= htmlspecialchars($job->getId(), ENT_COMPAT, 'utf-8'); ?></h1></header>
            <div class="inner">
            <table class="list w-100">
                    <tr>
                        <td><?= $this->getHtml('Status') ?>
                        <td><i class="fa fa-anchor"></i>
                        <td class="wf-100"><?= htmlspecialchars($job->getStatus(), ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Run') ?>
                        <td><i class="fa fa-anchor"></i>
                        <td><?= htmlspecialchars($job->getRun(), ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('LastRunTime') ?>
                        <td><i class="fa fa-anchor"></i>
                        <td><?= htmlspecialchars($job->getLastRunTime() !== null ? $job->getLastRunTime()->format('Y-m-d') : '', ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('NextRunTime') ?>
                        <td><i class="fa fa-anchor"></i>
                        <td><?= htmlspecialchars($job->getNextRunTime() !== null ? $job->getNextRunTime()->format('Y-m-d') : '', ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Description') ?>
                        <td><i class="fa fa-anchor"></i>
                        <td><blockquote><?= htmlspecialchars($job->getComment(), ENT_COMPAT, 'utf-8'); ?></blockquote>
            </table>
                
            </div>
        </section>
    </div>
</div>