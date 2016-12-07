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
/**
 * @var \phpOMS\Views\View         $this
 */
$job      = $this->getData('job');

echo $this->getData('nav')->render(); ?>

<section class="box w-50">
    <header><h1><?= $job->getId(); ?></h1></header>
    <div class="inner">
    <table class="list w-100">
            <tr>
                <td><?= $this->getText('Status'); ?>
                <td><i class="fa fa-anchor"></i>
                <td class="wf-100"><?= $job->getStatus(); ?>
            <tr>
                <td><?= $this->getText('Run'); ?>
                <td><i class="fa fa-anchor"></i>
                <td><?= $job->getRun(); ?>
            <tr>
                <td><?= $this->getText('LastRunTime'); ?>
                <td><i class="fa fa-anchor"></i>
                <td><?= $job->getLastRunTime() !== null ? $job->getLastRunTime()->format('Y-m-d') : ''; ?>
            <tr>
                <td><?= $this->getText('NextRunTime'); ?>
                <td><i class="fa fa-anchor"></i>
                <td><?= $job->getNextRunTime() !== null ? $job->getNextRunTime()->format('Y-m-d') : ''; ?>
            <tr>
                <td><?= $this->getText('Description'); ?>
                <td><i class="fa fa-anchor"></i>
                <td><blockquote><?= $job->getComment(); ?></blockquote>
    </table>
        
    </div>
</section>