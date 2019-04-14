<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

use \Modules\Tasks\Models\TaskPriority;
use \Modules\Tasks\Models\TaskStatus;
use \Modules\Admin\Models\Account;
use \Modules\Admin\Models\Group;

/**
 * @var \phpOMS\Views\View         $this
 * @var \Modules\Tasks\Models\Task $task
 */
$task      = $this->getData('task');
$taskMedia = $task->getMedia();
$elements  = $task->getTaskElements();
$cElements = \count($elements);
$color     = $this->getStatus($task->getStatus());

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <div class="floatRight">
                    <?php if ($task->getPriority() === TaskPriority::NONE) : ?>
                        Due: <?= $this->printHtml($task->getDue()->format('Y/m/d H:i')); ?>
                    <?php else : ?>
                        Priority: <?= $this->getHtml('P' . $task->getPriority()) ?>
                    <?php endif; ?>
                </div>
                <div>Created <?= $this->printHtml($task->getCreatedAt()->format('Y/m/d H:i')); ?></div>
            </div>
            <header><h1><?= $this->printHtml($task->getTitle()); ?></h1></header>
            <div class="inner">
                <?= $task->getDescription(); ?>
            </div>

            <?php if (!empty($taskMedia)) : ?>
            <div class="inner">
                <?php foreach ($taskMedia as $media) : ?>
                <span><?= $media->getName(); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="inner" style="background: #efefef; border-top: 1px solid #dfdfdf;">
                <div class="pAlignTable">
                    <div class="vCenterTable wf-100">By <?= $this->printHtml($task->getCreatedBy()->getName1()); ?></div>
                    <span id="task-status-badge" class="vCenterTable nobreak tag <?= $color; ?>" data-action='[
                        {
                            "key": 1, "listener": "click", "action": [
                                {"key": 1, "type": "dom.hide", "id": "task-status-badge"},
                                {"key": 2, "type": "dom.show", "id": "task-status"}
                            ]
                        }
                    ]'><?= $this->getHtml('S' . $task->getStatus()) ?></span>
                    <select id="task-status" class="vh" data-action='[
                        {
                            "key": 1, "listener": "change", "action": [
                                {"key": 1, "type": "dom.hide", "id": "task-status"},
                                {"key": 2, "type": "dom.show", "id": "task-status-badge"}
                            ]
                        }
                    ]'>
                        <option><?= $this->getHtml('S' . 1) ?>
                        <option><?= $this->getHtml('S' . 2) ?>
                        <option><?= $this->getHtml('S' . 3) ?>
                        <option><?= $this->getHtml('S' . 4) ?>
                        <option><?= $this->getHtml('S' . 5) ?>
                        <option><?= $this->getHtml('S' . 6) ?>
                    </select>
                </div>
            </div>
        </section>

        <?php $c = 0;
        foreach ($elements as $key => $element) : $c++;
            $color = $this->getStatus($element->getStatus()); ?>
            <?php $tos = $element->getTo(); if ($c > 1 && \count($tos) > 1) : ?>
                <section class="box wf-100">
                    <div class="inner">
                        Forwarded
                        <?php foreach ($toes as $to) : ?>
                            <?php if ($to instanceof Account) : ?>
                                <?= $this->printHtml($to->getRelation()->getName1()); ?>
                            <?php elseif ($to instanceof Group) : ?>
                                <?= $this->printHtml($to->getRelation()->getName()); ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>
            <section class="box wf-100">
                <div class="inner pAlignTable">
                    <div class="vCenterTable wf-100"><?= $this->printHtml($element->getCreatedBy()->getName1()); ?> <?= $this->printHtml($element->getCreatedAt()->format('Y-m-d H:i')); ?></div>
                    <span class="vCenterTable tag <?= $this->printHtml($color); ?>"><?= $this->getHtml('S' . $element->getStatus()) ?></span>
                </div>

                <?php if ($element->getDescription() !== '') : ?>
                    <div class="inner">
                        <?= $element->getDescription(); ?>
                    </div>
                <?php endif; ?>

                <?php $elementMedia = $element->getMedia(); if (!empty($elementMedia)) : ?>
                <div class="inner">
                    <?php foreach ($elementMedia as $media) : ?>
                    <span><?= $media->getName(); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="inner pAlignTable" style="background: #efefef; border-top: 1px solid #dfdfdf;">
                <?php if ($element->getStatus() !== TaskStatus::CANCELED ||
                    $element->getStatus() !== TaskStatus::DONE ||
                    $element->getStatus() !== TaskStatus::SUSPENDED || $c != $cElements
                ) : ?>
                    <div class="vCenterTable nobreak">
                        <?php if ($element->getPriority() === TaskPriority::NONE) : ?>
                            Due: <?= $this->printHtml($element->getDue()->format('Y/m/d H:i')); ?>
                        <?php else : ?>
                            Priority: <?= $this->getHtml('P' . $element->getPriority()) ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>

        <section class="box wf-100">
            <div class="inner">
                <form id="taskElementCreate" method="PUT" action="<?= \phpOMS\Uri\UriFactory::build('{/api}task/element?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tr><td><label for="iMessage"><?= $this->getHtml('Message') ?></label>
                        <tr><td><?= $this->getData('editor')->render('task-editor'); ?>
                        <tr><td><?= $this->getData('editor')->getData('text')->render('task-editor', 'plain', 'taskElementCreate'); ?>
                        <tr><td><label for="iPriority"><?= $this->getHtml('Priority') ?></label>
                        <tr><td>
                            <select id="iPriority" name="priority">
                                <option value="<?= $this->printHtml(TaskPriority::NONE); ?>"<?= $task->getPriority() === TaskPriority::NONE ? 'selected' : ''?>><?= $this->getHtml('P0') ?>
                                <option value="<?= $this->printHtml(TaskPriority::VLOW); ?>"<?= $task->getPriority() === TaskPriority::VLOW ? 'selected' : ''?>><?= $this->getHtml('P1') ?>
                                <option value="<?= $this->printHtml(TaskPriority::LOW); ?>"<?= $task->getPriority() === TaskPriority::LOW ? 'selected' : ''?>><?= $this->getHtml('P2') ?>
                                <option value="<?= $this->printHtml(TaskPriority::MEDIUM); ?>"<?= $task->getPriority() === TaskPriority::MEDIUM ? 'selected' : ''?>><?= $this->getHtml('P3') ?>
                                <option value="<?= $this->printHtml(TaskPriority::HIGH); ?>"<?= $task->getPriority() === TaskPriority::HIGH ? 'selected' : ''?>><?= $this->getHtml('P4') ?>
                                <option value="<?= $this->printHtml(TaskPriority::VHIGH); ?>"<?= $task->getPriority() === TaskPriority::VHIGH ? 'selected' : ''?>><?= $this->getHtml('P5') ?>
                            </select>
                        <tr><td><label for="iDue"><?= $this->getHtml('Due') ?></label>
                        <tr><td><input type="datetime-local" id="iDue" name="due" value="<?= $this->printHtml(!empty($elements) ? end($elements)->getDue()->format('Y-m-d\TH:i:s') : $task->getDue()->format('Y-m-d\TH:i:s')); ?>">
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status') ?></label>
                        <tr><td><select id="iStatus" name="status">
                                    <option value="<?= $this->printHtml(TaskStatus::OPEN); ?>"<?= $task->getStatus() === TaskStatus::OPEN ? 'selected' : ''?>>Open
                                    <option value="<?= $this->printHtml(TaskStatus::WORKING); ?>"<?= $task->getStatus() === TaskStatus::WORKING ? 'selected' : ''?>>Working
                                    <option value="<?= $this->printHtml(TaskStatus::SUSPENDED); ?>"<?= $task->getStatus() === TaskStatus::SUSPENDED ? 'selected' : ''?>>Suspended
                                    <option value="<?= $this->printHtml(TaskStatus::CANCELED); ?>"<?= $task->getStatus() === TaskStatus::CANCELED ? 'selected' : ''?>>Canceled
                                    <option value="<?= $this->printHtml(TaskStatus::DONE); ?>"<?= $task->getStatus() === TaskStatus::DONE ? 'selected' : ''?>>Done
                                </select>
                        <tr><td><label for="iReceiver"><?= $this->getHtml('To') ?></label>
                        <tr><td><?= $this->getData('accGrpSelector')->render('iReceiver', 'forward', true); ?>
                        <tr><td><label for="iMedia"><?= $this->getHtml('Media') ?></label>
                        <tr><td><div class="ipt-wrap">
                                <div class="ipt-first"><input type="text" id="iMedia" placeholder="&#xf15b; File"></div>
                                <div class="ipt-second"><button><?= $this->getHtml('Select') ?></button></div>
                            </div>
                        <tr><td><label for="iUpload"><?= $this->getHtml('Upload') ?></label>
                        <tr><td>
                            <input type="file" id="iUpload" name="fileUpload" form="fTask">
                            <input form="fTask" type="hidden" name="type">
                        <tr><td>
                            <input type="submit" id="iTaskElementCreateButton" name="taskElementCreateButton" value="<?= $this->getHtml('Create', 0, 0); ?>">
                            <input type="hidden" name="task" value="<?= $this->printHtml($this->request->getData('id')); ?>"><input type="hidden" name="type" value="1">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>
