<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   HumanResourceTimeRecording
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);


use \Modules\HumanResourceTimeRecording\Models\ClockingType;
use \Modules\HumanResourceTimeRecording\Models\ClockingStatus;

$sessions = $this->getData('sessions');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
        <table id="accountList" class="default">
                <caption><?= $this->getHtml('Recordings') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('Date'); ?>
                    <td>Status
                    <td>Employee
                    <td><?= $this->getHtml('Start') ?>
                    <td><?= $this->getHtml('Break') ?>
                    <td><?= $this->getHtml('End') ?>
                    <td><?= $this->getHtml('Total') ?>
                <tfoot>
                <tr><td colspan="5">
                <tbody>
                <?php foreach ($sessions as $session) : ?>
                <tr>
                    <td><?= $session->getStart()->format('Y-m-d'); ?>
                    <td><span class="tag">Status Here</span>
                    <td>
                        <?= $this->printHtml($session->getEmployee()->getProfile()->getAccount()->getName1()); ?>,
                        <?= $this->printHtml($session->getEmployee()->getProfile()->getAccount()->getName2()); ?>
                    <td><?= $session->getStart()->format('H:i:s'); ?>
                    <td><?= (int) ($session->getBreak() / 3600); ?>h <?= ((int) ($session->getBreak() / 60) % 60); ?>m
                    <td><?= $session->getEnd() !== null ? $session->getEnd()->format('H:i') : ''; ?>
                    <td><?= (int) ($session->getBusy() / 3600); ?>h <?= ((int) ($session->getBusy() / 60) % 60); ?>m
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
