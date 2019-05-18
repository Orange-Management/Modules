<?php declare(strict_types=1);
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

use \Modules\Admin\Models\Account;
use \Modules\Admin\Models\Group;
use \Modules\Tasks\Models\TaskPriority;
use \Modules\Tasks\Models\TaskStatus;

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
    <div class="col-md-6 col-xs-12">
        <section id="task" class="box wf-100"
            data-ui-content=".inner"
            data-ui-element="#task header, #task #task-content"
            data-tag="form"
        >
            <div class="inner">
                <template><!-- todo: this needs to be here for the form js to work (edit). find a way to remove these. maybe check if add functionality is available. --></template>
                <template><!-- todo: this needs to be here for the form js to work (edit). find a way to remove these. maybe check if add functionality is available. --></template>
                <template>
                    <header><h1><input type="text" data-tpl-text="/title" data-tpl-value="/title" data-value=""></h1></header>
                </template>
                <template>
                    <div id="task-content" class="inner">
                        <!-- todo: handle different value/markdown paths how??? no idea -->
                        <!-- todo: bind js after adding template -->
                        <?= $this->getData('editor')->render('task-edit'); ?>
                        <?= $this->getData('editor')->getData('text')->render(
                            'task-edit',
                            'plain',
                            'taskElementEdit',
                            '', '',
                            '/content', '/content'
                        ); ?>
                        <!--<textarea data-tpl-text="/content" data-tpl-value="/content" data-value=""></textarea>-->
                    </div>
                </template>

                <span id="task-status-badge" class="floatRight nobreak tag task-status-<?= $this->printHtml($task->getStatus()); ?>">
                    <?= $this->getHtml('S' . $task->getStatus()) ?>
                </span>
                <div class="floatRight">
                    <?php if ($task->getPriority() === TaskPriority::NONE) : ?>
                        <?= $this->getHtml('Due') ?>: <?= $this->printHtml($task->getDue()->format('Y/m/d H:i')); ?>
                    <?php else : ?>
                        <?= $this->getHtml('Priority') ?>: <?= $this->getHtml('P' . $task->getPriority()) ?>
                    <?php endif; ?>
                </div>
                <div><?= $this->getHtml('Created') ?> - <?= $this->printHtml($task->getCreatedAt()->format('Y/m/d H:i')); ?></div>
            </div>
            <header>
                <h1 data-tpl-text="/title" data-tpl-value="/title" data-value=""><?= $this->printHtml($task->getTitle()); ?></h1>
            </header>
            <div id="task-content" class="inner">
                <div data-tpl-text="/content" data-tpl-value="/content" data-value=""><?= $task->getDescription(); ?></div>
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
                    <div class="vC wf-100">
                        <?= $this->getHtml('By') ?> <?= $this->printHtml($task->getCreatedBy()->getName1()); ?>
                    </div>
                    <div class="vC">
                        <button class="save hidden"><?= $this->getHtml('Save', '0', '0') ?></button>
                        <button class="cancel hidden"><?= $this->getHtml('Cancel', '0', '0') ?></button>
                        <button class="update"><?= $this->getHtml('Edit', '0', '0') ?></button>
                    </div>
                </div>
            </div>
        </section>

        <?php $c = 0;
        foreach ($elements as $key => $element) : $c++; ?>
            <?php $tos = $element->getTo(); if ($c > 1 && \count($tos) > 1) : ?>
                <section class="box wf-100">
                    <div class="inner">
                        <?= $this->getHtml('Forwarded') ?>
                        <?php foreach ($tos as $to) : ?>
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
                    <div class="vC wf-100">
                        <?= $this->printHtml($element->getCreatedBy()->getName1()); ?> - <?= $this->printHtml($element->getCreatedAt()->format('Y-m-d H:i')); ?>
                    </div>
                    <span class="vC tag task-status-<?= $this->printHtml($task->getStatus()); ?>">
                        <?= $this->getHtml('S' . $element->getStatus()) ?>
                    </span>
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
                <?php if ($element->getStatus() !== TaskStatus::CANCELED
                    || $element->getStatus() !== TaskStatus::DONE
                    || $element->getStatus() !== TaskStatus::SUSPENDED
                    || $c != $cElements
                ) : ?>
                    <div class="vC nobreak">
                        <?php if ($element->getPriority() === TaskPriority::NONE) : ?>
                            <?= $this->getHtml('Due') ?>: <?= $this->printHtml($element->getDue()->format('Y/m/d H:i')); ?>
                        <?php else : ?>
                            <?= $this->getHtml('Priority') ?>: <?= $this->getHtml('P' . $element->getPriority()) ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>
    </div>

    <div class="col-md-6 col-xs-12">
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
                                <option value="<?= TaskPriority::NONE; ?>"<?= $task->getPriority() === TaskPriority::NONE ? ' selected' : ''?>><?= $this->getHtml('P0') ?>
                                <option value="<?= TaskPriority::VLOW; ?>"<?= $task->getPriority() === TaskPriority::VLOW ? ' selected' : ''?>><?= $this->getHtml('P1') ?>
                                <option value="<?= TaskPriority::LOW; ?>"<?= $task->getPriority() === TaskPriority::LOW ? ' selected' : ''?>><?= $this->getHtml('P2') ?>
                                <option value="<?= TaskPriority::MEDIUM; ?>"<?= $task->getPriority() === TaskPriority::MEDIUM ? ' selected' : ''?>><?= $this->getHtml('P3') ?>
                                <option value="<?= TaskPriority::HIGH; ?>"<?= $task->getPriority() === TaskPriority::HIGH ? ' selected' : ''?>><?= $this->getHtml('P4') ?>
                                <option value="<?= TaskPriority::VHIGH; ?>"<?= $task->getPriority() === TaskPriority::VHIGH ? ' selected' : ''?>><?= $this->getHtml('P5') ?>
                            </select>
                        <tr><td><label for="iDue"><?= $this->getHtml('Due') ?></label>
                        <tr><td><input type="datetime-local" id="iDue" name="due" value="<?= $this->printHtml(
                                !empty($elements) ? \end($elements)->getDue()->format('Y-m-d\TH:i:s') : $task->getDue()->format('Y-m-d\TH:i:s')
                            ); ?>">
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status') ?></label>
                        <tr><td><select id="iStatus" name="status">
                                    <option value="<?= TaskStatus::OPEN; ?>"<?= $task->getStatus() === TaskStatus::OPEN ? ' selected' : ''?>><?= $this->getHtml('S1') ?>
                                    <option value="<?= TaskStatus::WORKING; ?>"<?= $task->getStatus() === TaskStatus::WORKING ? ' selected' : ''?>><?= $this->getHtml('S2') ?>
                                    <option value="<?= TaskStatus::SUSPENDED; ?>"<?= $task->getStatus() === TaskStatus::SUSPENDED ? ' selected' : ''?>><?= $this->getHtml('S3') ?>
                                    <option value="<?= TaskStatus::CANCELED; ?>"<?= $task->getStatus() === TaskStatus::CANCELED ? ' selected' : ''?>><?= $this->getHtml('S4') ?>
                                    <option value="<?= TaskStatus::DONE; ?>"<?= $task->getStatus() === TaskStatus::DONE ? ' selected' : ''?>><?= $this->getHtml('S5') ?>
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
                        <tr><td>
                            <input type="submit" id="iTaskElementCreateButton" name="taskElementCreateButton" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                            <input type="hidden" name="task" value="<?= $this->printHtml($this->request->getData('id')); ?>"><input type="hidden" name="type" value="1">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>
