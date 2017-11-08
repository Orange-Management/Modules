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
 * @link       http://website.orange-management.de
 */

$event = $this->getData('event');
$tasks = $event->getTasks();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->printHtml($event->getName()); ?></h1></header>
            <div class="inner">
                <form id="fEvent" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/eventmanagement?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iName"><?= $this->getHtml('Name') ?></label>
                        <tr><td colspan="2"><input type="text" id="iName" name="name" placeholder="&#xf007; Name" value="<?= $this->printHtml($event->getName()); ?>" required>
                        <tr><td><label for="iStart"><?= $this->getHtml('Start') ?></label>
                            <td><label for="iEnd"><?= $this->getHtml('End') ?></label>
                        <tr><td><input type="datetime-local" id="iStart" name="start" value="<?= $this->printHtml($event->getStart()->format('Y-m-d\TH:i:s')); ?>">
                            <td><input type="datetime-local" id="iEnd" name="end" value="<?= $this->printHtml($event->getEnd()->format('Y-m-d\TH:i:s')); ?>">
                        <tr><td colspan="2"><label for="iDescription"><?= $this->getHtml('Description') ?></label>
                        <tr><td colspan="2"><textarea id="iDescription" name="desc"><?= $this->printHtml($event->getDescription()); ?></textarea>
                        <tr><td colspan="2"><label for="iProgressType"><?= $this->getHtml('Progress') ?></label>
                        <tr><td><select id="iProgressType" name="progressType">
                                    <option value="<?= \Modules\EventManagement\Models\ProgressType::MANUAL; ?>"><?= $this->getHtml('Manual') ?>
                                    <option value="<?= \Modules\EventManagement\Models\ProgressType::LINEAR; ?>"><?= $this->getHtml('Linear') ?>
                                    <option value="<?= \Modules\EventManagement\Models\ProgressType::EXPONENTIAL; ?>"><?= $this->getHtml('Exponential') ?>
                                    <option value="<?= \Modules\EventManagement\Models\ProgressType::LOG; ?>"><?= $this->getHtml('Log') ?>
                                    <option value="<?= \Modules\EventManagement\Models\ProgressType::TASKS; ?>"><?= $this->getHtml('Tasks') ?>
                                </select>
                            <td><input type="text" id="iProgress" name="progress" value="<?= $event->getProgress(); ?>"<?= $event->getProgressType() !== \Modules\EventManagement\Models\ProgressType::MANUAL ? ' disabled' : ''; ?>>
                        <tr><td><label for="iBudget"><?= $this->getHtml('Budget') ?></label><td><label for="iActual"><?= $this->getHtml('Actual') ?></label>
                        <tr><td><input type="text" id="iBudget" name="budget" placeholder=""><td><input type="text" id="iActual" name="actual">
                        <tr><td colspan="2"><input type="submit" value="<?= $this->getHtml('Save', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="box wf-100">
            <?= $this->getData('tasklist')->render($event->getTasks()); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <?= $this->getData('calendar')->render($event->getCalendar()); ?>
    </div>

    <div class="col-xs-12 col-md-6">
    <?= $this->getData('medialist')->render($event->getMedia()); ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1>Finances</h1></header>
        </section>
    </div>
</div>