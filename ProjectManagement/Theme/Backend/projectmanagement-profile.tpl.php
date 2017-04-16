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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
$project = $this->getData('project');
$tasks = $project->getTasks();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $project->getName(); ?></h1></header>
            <div class="inner">
                <form id="fProject" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/projectmanagement?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iName"><?= $this->getText('Name'); ?></label>
                        <tr><td colspan="2"><input type="text" id="iName" name="name" placeholder="&#xf007; Name" value="<?= $project->getName(); ?>" required>
                        <tr><td><label for="iStart"><?= $this->getText('Start'); ?></label>
                            <td><label for="iEnd"><?= $this->getText('End'); ?></label>
                        <tr><td><input type="datetime-local" id="iStart" name="start" value="<?= $project->getStart()->format('Y-m-d\TH:i:s'); ?>">
                            <td><input type="datetime-local" id="iEnd" name="end" value="<?= $project->getEnd()->format('Y-m-d\TH:i:s'); ?>">
                        <tr><td colspan="2"><label for="iDescription"><?= $this->getText('Description'); ?></label>
                        <tr><td colspan="2"><textarea id="iDescription" name="desc"><?= $project->getDescription(); ?></textarea>
                        <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Save', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getText('Tasks', 'Tasks'); ?></caption>
                <thead>
                    <td><?= $this->getText('Status'); ?>
                    <td><?= $this->getText('Due', 'Tasks'); ?>
                    <td class="full"><?= $this->getText('Title'); ?>
                <tfoot>
                <tbody>
                <?php $c = 0; foreach($tasks as $key => $task) : $c++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/task/single?{?}&id=' . $task->getId());
                $color = 'darkred';
                if($task->getStatus() === \Modules\Tasks\Models\TaskStatus::DONE) { $color = 'green'; }
                elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::OPEN) { $color = 'darkblue'; }
                elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::WORKING) { $color = 'purple'; }
                elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::CANCELED) { $color = 'red'; }
                elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::SUSPENDED) { $color = 'yellow'; } ;?>
                    <tr>
                        <td><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->getText('S' . $task->getStatus(), 'Tasks'); ?></span></a>
                        <td><a href="<?= $url; ?>"><?= $task->getDue()->format('Y-m-d H:i'); ?></a>
                        <td><a href="<?= $url; ?>"><?= $task->getTitle(); ?></a>
                <?php endforeach; if($c == 0) : ?>
                <tr><td colspan="6" class="empty"><?= $this->getText('Empty', 0, 0); ?>
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