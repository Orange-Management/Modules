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
 * @link       http://orange-management.com
 */

$event = $this->getData('event');
$tasks = $event->getTasks();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->printHtml($event->getName()); ?></h1></header>
            <div class="inner">
                <form id="fEvent" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/eventmanagement?{?}&csrf={$CSRF}'); ?>">
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
                            <td><input type="text" id="iProgress" name="progress" value="<?= $project->getProgress(); ?>"<?= $project->getProgressType() !== \Modules\EventManagement\Models\ProgressType::MANUAL ? ' disabled' : ''; ?>>
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
            <table class="table red">
                <caption><?= $this->getHtml('Tasks', 'Tasks') ?></caption>
                <thead>
                    <td><?= $this->getHtml('Status') ?>
                    <td><?= $this->getHtml('Due', 'Tasks') ?>
                    <td class="full"><?= $this->getHtml('Title') ?>
                <tfoot>
                <tbody>
                <?php $c = 0; foreach($tasks as $key => $task) : $c++;
                $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/task/single?{?}&id=' . $task->getId());
                $color = 'darkred';
                if($task->getStatus() === \Modules\Tasks\Models\TaskStatus::DONE) { $color = 'green'; }
                elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::OPEN) { $color = 'darkblue'; }
                elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::WORKING) { $color = 'purple'; }
                elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::CANCELED) { $color = 'red'; }
                elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::SUSPENDED) { $color = 'yellow'; } ;?>
                    <tr data-href="<?= $url; ?>">
                        <td><a href="<?= $url; ?>"><span class="tag <?= $this->printHtml($color); ?>"><?= $this->getHtml('S' . $task->getStatus(), 'Tasks') ?></span></a>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($task->getDue()->format('Y-m-d H:i')); ?></a>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($task->getTitle()); ?></a>
                <?php endforeach; if($c == 0) : ?>
                <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1>Calendar</h1></header>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1>Media</h1></header>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1>Finances</h1></header>
        </section>
    </div>
</div>