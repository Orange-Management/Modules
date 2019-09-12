<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   TBD
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */

use \Modules\HumanResourceTimeRecording\Models\ClockingType;
use \Modules\HumanResourceTimeRecording\Models\ClockingStatus;

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
                            </select>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status') ?></label>
                        <tr><td>
                            <select id="iStatus" name="Status">
                                <option value="<?= ClockingStatus::START; ?>"><?= $this->getHtml('CS0') ?>
                                <option value="<?= ClockingStatus::PAUSE; ?>"><?= $this->getHtml('CS1') ?>
                                <option value="<?= ClockingStatus::ON_THE_MOVE; ?>"><?= $this->getHtml('CS2') ?>
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

    <div class="col-md-4 col-xs-12">
        <section class="box wf-100">
            <div class="inner">
            </div>
        </section>
    </div>
</div>

on response successfull reload!!! or!
on response successfull change ui/change ui and on response not successfull undo changed ui both result in the same

list for month show total of total
list contains segments for week show total of total
every week contains every day show total of total
if you click on a day you get detailed information of that day

show additional section with vacation days