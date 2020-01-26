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


use \Modules\HumanResourceTimeRecording\Models\ClockingStatus;
use \Modules\HumanResourceTimeRecording\Models\ClockingType;

$sessions = $this->getData('sessions');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-md-4 col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <form id="clocking" method="PUT" action="<?= \phpOMS\Uri\UriFactory::build('{/api}task/element?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tr><td><label for="iType"><?= $this->getHtml('Type') ?></label>
                        <tr><td>
                            <select id="iType" name="Type">
                                <option value="<?= ClockingType::OFFICE; ?>"><?= $this->getHtml('CT0') ?>
                                <option value="<?= ClockingType::REMOTE; ?>"><?= $this->getHtml('CT1') ?>
                                <option value="<?= ClockingType::HOME; ?>"><?= $this->getHtml('CT2') ?>
                                <option value="<?= ClockingType::VACATION; ?>"><?= $this->getHtml('CT3') ?>
                                <option value="<?= ClockingType::SICK; ?>"><?= $this->getHtml('CT4') ?>
                                <option value="<?= ClockingType::ON_THE_MOVE; ?>"><?= $this->getHtml('CT5') ?>
                            </select>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status') ?></label>
                        <tr><td>
                            <select id="iStatus" name="Status">
                                <option value="<?= ClockingStatus::START; ?>"><?= $this->getHtml('CS0') ?>
                                <option value="<?= ClockingStatus::PAUSE; ?>"><?= $this->getHtml('CS1') ?>
                                <option value="<?= ClockingStatus::CONTINUE; ?>"><?= $this->getHtml('CS2') ?>
                                <option value="<?= ClockingStatus::END; ?>"><?= $this->getHtml('CS3') ?>
                            </select>
                        <tr><td>
                            <input type="submit" id="iclockingButton" name="clockingButton" value="<?= $this->getHtml('Submit', '0', '0'); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-md-4 col-xs-12">
        <section class="box wf-100">
            <header><h1>Work</h1></header>
            <div class="inner">
                <table>
                    <tr><td>This month<td>
                    <tr><td>Last month<td>
                    <tr><td>This year<td>
                </table>
            </div>
        </section>
    </div>

    <div class="col-md-4 col-xs-12">
        <section class="box wf-100">
            <header><h1>Vaction</h1></header>
            <div class="inner">
                <table>
                    <tr><td>Used Vacation<td>
                    <tr><td>Last Vacation<td>
                    <tr><td>Next Vacation<td>
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
        <table id="accountList" class="default">
                <caption><?= $this->getHtml('Recordings') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('Date'); ?>
                    <td>Status
                    <td><?= $this->getHtml('Start') ?>
                    <td><?= $this->getHtml('Break') ?>
                    <td><?= $this->getHtml('End') ?>
                    <td><?= $this->getHtml('Total') ?>
                <tfoot>
                <tr><td colspan="5">
                <tbody>
                <?php foreach ($sessions as $session) : ?>
                <tr>
                    <td><?= $session->getStart()->format('Y-m-d'); ?> - <?= $this->getHtml('D' . $session->getStart()->format('w')); ?>
                    <td><span class="tag">Status Here</span>
                    <td><?= $session->getStart()->format('H:i'); ?>
                    <td><?= (int) ($session->getBreak() / 3600); ?>h <?= ((int) ($session->getBreak() / 60) % 60); ?>m
                    <td><?= $session->getEnd() !== null ? $session->getEnd()->format('H:i') : ''; ?>
                    <td><?= (int) ($session->getBusy() / 3600); ?>h <?= ((int) ($session->getBusy() / 60) % 60); ?>m
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
