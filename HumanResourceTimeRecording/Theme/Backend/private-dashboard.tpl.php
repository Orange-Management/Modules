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
use \phpOMS\Stdlib\Base\SmartDateTime;

/** @var Session[] $sessions */
$sessions     = $this->getData('sessions');
$sessionCount = \count($sessions);

/** @var Session $lastOpenSession */
$lastOpenSession = $this->getData('lastSession');

$type   = $lastOpenSession !== null ? $lastOpenSession->getType() : ClockingType::OFFICE;
$status = $lastOpenSession !== null ? $lastOpenSession->getStatus() : ClockingStatus::END;

/** @var \phpOMS\Stdlib\Base\SmartDateTime $startWeek */
$startWeek = new SmartDateTime('now');
$startWeek = $startWeek->getStartOfWeek();
$endWeek   = $startWeek->createModify(0, 0, 6);

$startMonth = new SmartDateTime('now');
$startMonth = $startMonth->getStartOfMonth();
$endMonth   = $startMonth->createModify(0, 1, -1);

$busy = [
    'total' => 0,
    'month' => 0,
    'week' => 0,
];

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <form id="iClocking" method="PUT" action="<?= \phpOMS\Uri\UriFactory::build('{/api}humanresource/timerecording/element?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tr><td><label for="iType"><?= $this->getHtml('Type') ?></label>
                        <tr><td>
                            <select id="iType" name="type">
                                <option value="<?= ClockingType::OFFICE; ?>"<?= $type === ClockingType::OFFICE ? ' selected': ''; ?>><?= $this->getHtml('CT1') ?>
                                <option value="<?= ClockingType::REMOTE; ?>"<?= $type === ClockingType::REMOTE ? ' selected': ''; ?>><?= $this->getHtml('CT3') ?>
                                <option value="<?= ClockingType::HOME; ?>"<?= $type === ClockingType::HOME ? ' selected': ''; ?>><?= $this->getHtml('CT2') ?>
                                <option value="<?= ClockingType::VACATION; ?>"<?= $type === ClockingType::VACATION ? ' selected': ''; ?>><?= $this->getHtml('CT4') ?>
                                <option value="<?= ClockingType::SICK; ?>"<?= $type === ClockingType::SICK ? ' selected': ''; ?>><?= $this->getHtml('CT5') ?>
                                <option value="<?= ClockingType::ON_THE_MOVE; ?>"<?= $type === ClockingType::ON_THE_MOVE ? ' selected': ''; ?>><?= $this->getHtml('CT6') ?>
                            </select>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status') ?></label>
                        <tr><td>
                            <select id="iStatus" name="status">
                                <option value="<?= ClockingStatus::START; ?>"<?= $status === ClockingStatus::END ? ' selected' : ''; ?>><?= $this->getHtml('CS1') ?>
                                <option value="<?= ClockingStatus::PAUSE; ?>"<?= $status === ClockingStatus::START ? ' selected' : ''; ?>><?= $this->getHtml('CS2') ?>
                                <option value="<?= ClockingStatus::CONTINUE; ?>"<?= $status === ClockingStatus::PAUSE ? ' selected' : ''; ?>><?= $this->getHtml('CS3') ?>
                                <option value="<?= ClockingStatus::END; ?>"<?= $status === ClockingStatus::CONTINUE ? ' selected' : ''; ?>><?= $this->getHtml('CS4') ?>
                            </select>
                        <tr><td>
                            <input type="hidden" name="session" value="<?= $lastOpenSession !== null ? $lastOpenSession->getId() : ''; ?>">
                            <input type="submit" id="iclockingButton" name="clockingButton" value="<?= $this->getHtml('Submit', '0', '0'); ?>" data-action='[
                                    {
                                        "key": 1, "listener": "click", "action": [
                                            {"key": 1, "type": "dom.reload", "delay": 3000}
                                        ]
                                    }
                                ]'>
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
                    <td><?= $this->getHtml('Type'); ?>
                    <td><?= $this->getHtml('Status'); ?>
                    <td><?= $this->getHtml('Start'); ?>
                    <td><?= $this->getHtml('Break'); ?>
                    <td><?= $this->getHtml('End'); ?>
                    <td><?= $this->getHtml('Total'); ?>
                <tfoot>
                <tr><td colspan="5">
                <tbody>
                <?php
                    $count = 0; foreach ($sessions as $session) : ++$count;
                    $url = \phpOMS\Uri\UriFactory::build('{/prefix}private/timerecording/session?{?}&id=' . $session->getId());
                ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>">
                        <?php if ($lastOpenSession !== null && $session->getStart()->format('Y-m-d') === $lastOpenSession->getStart()->format('Y-m-d')) : ?>
                            <span class="tag">Today</span>
                        <?php else : ?>
                            <?= $session->getStart()->format('Y-m-d'); ?> - <?= $this->getHtml('D' . $session->getStart()->format('w')); ?>
                        <?php endif; ?></a>
                    <td><a href="<?= $url; ?>"><span class="tag"><?= $this->getHtml('CT' . $session->getType()) ?></span></a>
                    <td><a href="<?= $url; ?>"><span class="tag"><?= $this->getHtml('CS' . $session->getStatus()) ?></span></a>
                    <td><a href="<?= $url; ?>"><?= $session->getStart()->format('H:i'); ?></a>
                    <td><a href="<?= $url; ?>"><?= (int) ($session->getBreak() / 3600); ?>h <?= ((int) ($session->getBreak() / 60) % 60); ?>m</a>
                    <td><a href="<?= $url; ?>"><?= $session->getEnd() !== null ? $session->getEnd()->format('H:i') : ''; ?></a>
                    <td><a href="<?= $url; ?>"><?= (int) ($session->getBusy() / 3600); ?>h <?= ((int) ($session->getBusy() / 60) % 60); ?>m</a>
                <?php $busy['week'] += $session->getBusy(); if ($session->getStart()->getTimestamp() < $startWeek->getTimestamp() || $count === $sessionCount) : ?>
                <tr>
                    <th colspan="6"> <?= $startWeek->format('Y/m/d'); ?> - <?= $endWeek->format('Y/m/d'); ?>
                    <th><?= (int) ($busy['week'] / 3600); ?>h <?= ((int) ($busy['week'] / 60) % 60); ?>m
                <?php
                        $endWeek      = $startWeek;
                        $startWeek    = $startWeek->createModify(0, 0, -7);
                        $busy['week'] = 0;
                    endif;
                ?>
                <?php $busy['month'] += $session->getBusy(); if ($session->getStart()->getTimestamp() < $startMonth->getTimestamp() || $count === $sessionCount) : ?>
                <tr>
                    <th colspan="6"> <?= $startMonth->format('Y/m/d'); ?> - <?= $endMonth->format('Y/m/d'); ?>
                    <th><?= (int) ($busy['month'] / 3600); ?>h <?= ((int) ($busy['month'] / 60) % 60); ?>m
                <?php
                        $endMonth      = $startMonth;
                        $startMonth    = $startMonth->createModify(0, -1, 0);
                        $busy['month'] = 0;
                    endif;
                ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>