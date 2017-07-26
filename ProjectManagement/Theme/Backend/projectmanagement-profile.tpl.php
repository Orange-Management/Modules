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
$project = $this->getData('project');
$tasks = $project->getTasks();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= htmlspecialchars($project->getName(), ENT_COMPAT, 'utf-8'); ?></h1></header>
            <div class="inner">
                <form id="fProject" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/projectmanagement?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iName"><?= $this->getHtml('Name') ?></label>
                        <tr><td colspan="2"><input type="text" id="iName" name="name" placeholder="&#xf007; Name" value="<?= htmlspecialchars($project->getName(), ENT_COMPAT, 'utf-8'); ?>" required>
                        <tr><td><label for="iStart"><?= $this->getHtml('Start') ?></label>
                            <td><label for="iEnd"><?= $this->getHtml('End') ?></label>
                        <tr><td><input type="datetime-local" id="iStart" name="start" value="<?= htmlspecialchars($project->getStart()->format('Y-m-d\TH:i:s'), ENT_COMPAT, 'utf-8'); ?>">
                            <td><input type="datetime-local" id="iEnd" name="end" value="<?= htmlspecialchars($project->getEnd()->format('Y-m-d\TH:i:s'), ENT_COMPAT, 'utf-8'); ?>">
                        <tr><td colspan="2"><label for="iDescription"><?= $this->getHtml('Description') ?></label>
                        <tr><td colspan="2"><textarea id="iDescription" name="desc"><?= htmlspecialchars($project->getDescription(), ENT_COMPAT, 'utf-8'); ?></textarea>
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
                    <tr>
                        <td><a href="<?= $url; ?>"><span class="tag <?= htmlspecialchars($color, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('S' . $task->getStatus(), 'Tasks') ?></span></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($task->getDue()->format('Y-m-d H:i'), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($task->getTitle(), ENT_COMPAT, 'utf-8'); ?></a>
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