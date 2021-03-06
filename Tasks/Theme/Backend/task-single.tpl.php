<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tasks
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use \Modules\Tasks\Models\AccountRelation;
use \Modules\Tasks\Models\GroupRelation;
use \Modules\Tasks\Models\TaskPriority;
use \Modules\Tasks\Models\TaskStatus;

/**
 * @var \Modules\Tasks\Views\TaskView $this
 * @var \Modules\Tasks\Models\Task    $task
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
            data-ui-element="#task header, #task .task-content"
            data-tag="form"
            data-method="POST"
            data-uri="<?= \phpOMS\Uri\UriFactory::build('{/api}task?id={?id}&csrf={$CSRF}'); ?>">
            <div class="inner">
                <?php if ($task->isEditable()) : ?>
                <template><!-- todo: this needs to be here for the form js to work (edit). find a way to remove these. maybe check if add functionality is available. --></template>
                <template><!-- todo: this needs to be here for the form js to work (edit). find a way to remove these. maybe check if add functionality is available. --></template>
                <template>
                    <header><h1><input type="text" data-tpl-text="/title" data-tpl-value="/title" data-value="" name="title"></h1></header>
                </template>
                <template>
                    <div class="inner task-content">
                        <!-- todo: handle different value/markdown paths how??? no idea -->
                        <!-- todo: bind js after adding template -->
                        <!-- todo: adding this multiple times doesn't work because the id and tab names collide, this needs to be adjusted dynamically in js!!! how? no idea yet. -->
                        <?= $this->getData('editor')->render('task-edit'); ?>
                        <?= $this->getData('editor')->getData('text')->render(
                            'task-edit',
                            'plain',
                            'taskElementEdit',
                            '', '',
                            '/content', '{/api}task?id={?id}'
                        ); ?>
                        <!--<textarea data-tpl-text="/content" data-tpl-value="/content" data-value=""></textarea>-->
                    </div>
                </template>
                <?php endif; ?>

                <span id="task-status-badge" class="floatRight nobreak tag task-status-<?= $this->printHtml($task->getStatus()); ?>">
                    <?= $this->getHtml('S' . $task->getStatus()) ?>
                </span>
                <div>
                    <?= $this->printHtml($task->getCreatedBy()->getName1()); ?> - <?= $this->printHtml($task->getCreatedAt()->format('Y/m/d H:i')); ?>
                </div>
            </div>
            <header>
                <h1 data-tpl-text="/title" data-tpl-value="/title" data-value=""><?= $this->printHtml($task->getTitle()); ?></h1>
            </header>
            <div class="inner task-content">
                <article data-tpl-text="/content" data-tpl-value="{/api}task?id={?id}" data-value=""><?= $task->getDescription(); ?></article>
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
                        <?php if ($task->getPriority() === TaskPriority::NONE) : ?>
                            <?= $this->getHtml('Due') ?>: <?= $this->printHtml($task->getDue()->format('Y/m/d H:i')); ?>
                        <?php else : ?>
                            <?= $this->getHtml('Priority') ?>: <?= $this->getHtml('P' . $task->getPriority()) ?>
                        <?php endif; ?>
                    </div>

                    <?php if ($task->isEditable() && $this->request->getHeader()->getAccount() === $task->getCreatedBy()->getId()) : ?>
                        <div class="vC">
                            <button class="save hidden"><?= $this->getHtml('Save', '0', '0') ?></button>
                            <button class="cancel hidden"><?= $this->getHtml('Cancel', '0', '0') ?></button>
                            <button class="update"><?= $this->getHtml('Edit', '0', '0') ?></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <div id="elements">
            <!-- todo: this doesn't work because single taskelements cannot be identified somehow we need to work with ids of elements, implement a counter for the current element or implement a nearest() function instead of the this.closest() -->
            <?php if ($task->isEditable()) : ?>
            <template>
                <section id="taskelmenet-0" class="box wf-100 taskelement"
                    data-ui-content="#elements"
                    data-ui-element=".taskelement .taskelement-content"
                    data-tag="form"
                    data-method="POST"
                    data-uri="<?= \phpOMS\Uri\UriFactory::build('{/api}task/element?{?}&csrf={$CSRF}'); ?>">
                    <div class="inner pAlignTable">
                        <div class="vC wf-100">
                            <!-- created by --> - <!-- created at -->
                        </div>
                        <span class="vC tag task-status-0">
                            <!-- status-->
                        </span>
                    </div>

                    <div class="inner taskelement-content">
                        <article data-tpl-text="/content" data-tpl-value="{/api}task?id={?id}" data-value=""></article>
                    </div>

                    <div class="inner">
                        <!-- media here -->
                    </div>

                    <div class="inner pAlignTable" style="background: #efefef; border-top: 1px solid #dfdfdf;">
                        <div class="vC wf-100 nobreak">
                            <!-- due / priority -->
                        </div>

                        <div class="vC">
                            <input type="hidden" value="" name="id">
                            <button class="save hidden"><?= $this->getHtml('Save', '0', '0') ?></button>
                            <button class="cancel hidden"><?= $this->getHtml('Cancel', '0', '0') ?></button>
                            <button class="update"><?= $this->getHtml('Edit', '0', '0') ?></button>
                        </div>
                </section>
            </template>
            <template>
                <div class="inner taskelement-content">
                    <!-- todo: handle different value/markdown paths how??? no idea -->
                    <!-- todo: bind js after adding template -->
                    <!-- todo: adding this multiple times doesn't work because the id and tab names collide, this needs to be adjusted dynamically in js!!! how? no idea yet. -->
                    <?= $this->getData('editor')->render('task-edit'); ?>
                    <?= $this->getData('editor')->getData('text')->render(
                            'task-edit',
                            'plain',
                            'taskElementEdit',
                            '', '',
                            '/content', '{/api}task?id={?id}'
                        ); ?>
                    <!--<textarea data-tpl-text="/content" data-tpl-value="/content" data-value=""></textarea>-->
                </div>
            </template>
            <?php endif; ?>
            <?php $c = 0; $previous = null;
            foreach ($elements as $key => $element) : ++$c;
                if ($element->getDescription() !== '') :
            ?>
                <section id="taskelmenet-<?= $c; ?>" class="box wf-100 taskelement"
                    data-ui-content="#elements"
                    data-ui-element=".taskelement .taskelement-content"
                    data-tag="form"
                    data-method="POST"
                    data-uri="<?= \phpOMS\Uri\UriFactory::build('{/api}task/element?{?}&csrf={$CSRF}'); ?>">
                    <div class="inner pAlignTable">
                        <div class="vC wf-100">
                            <?= $this->printHtml($element->getCreatedBy()->getName1()); ?> - <?= $this->printHtml($element->getCreatedAt()->format('Y-m-d H:i')); ?>
                        </div>
                        <span class="vC tag task-status-<?= $this->printHtml($element->getStatus()); ?>">
                            <?= $this->getHtml('S' . $element->getStatus()) ?>
                        </span>
                    </div>

                    <?php if ($element->getDescription() !== '') : ?>
                        <div class="inner taskelement-content">
                            <article data-tpl-text="/content" data-tpl-value="{/api}task?id={?id}" data-value=""><?= $element->getDescription(); ?></article>
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
                        <div class="vC wf-100 nobreak">
                            <?php
                                if ($element->getPriority() === TaskPriority::NONE
                                    && ($previous !== null
                                        && $previous->getDue()->format('Y/m/d H:i') !== $element->getDue()->format('Y/m/d H:i')
                                    )
                                ) : ?>
                                <?= $this->getHtml('Due') ?>: <?= $this->printHtml($element->getDue()->format('Y/m/d H:i')); ?>
                            <?php elseif ($previous !== null && $previous->getPriority() !== $element->getPriority()) : ?>
                                <?= $this->getHtml('Priority') ?>: <?= $this->getHtml('P' . $element->getPriority()) ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($task->isEditable()
                        && $this->request->getHeader()->getAccount() === $element->getCreatedBy()->getId()
                    ) : ?>
                        <div class="vC">
                            <input type="hidden" value="<?= $element->getId(); ?>" name="id">
                            <button class="save hidden"><?= $this->getHtml('Save', '0', '0') ?></button>
                            <button class="cancel hidden"><?= $this->getHtml('Cancel', '0', '0') ?></button>
                            <button class="update"><?= $this->getHtml('Edit', '0', '0') ?></button>
                        </div>
                    <?php endif; ?>
                </section>
                <?php endif; ?>

                <?php
                    $tos = $element->getTo();
                    if (\count($tos) > 1
                        || (\count($tos) > 0 && $tos[0]->getRelation()->getId() !== $task->getCreatedBy()->getId())
                    ) : ?>
                    <section class="box wf-100">
                        <div class="inner">
                            <?= $this->getHtml('ForwardedTo') ?>
                            <?php foreach ($tos as $to) : ?>
                                <?php if ($to instanceof AccountRelation) : ?>
                                    <a href="<?= phpOMS\Uri\UriFactory::build('{/prefix}profile/single?{?}&id=' . $to->getRelation()->getId()) ?>"><?= $this->printHtml($to->getRelation()->getName1()); ?></a>
                                <?php elseif ($to instanceof GroupRelation) : ?>
                                    <?= $this->printHtml($to->getRelation()->getName()); ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; $previous = $element; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <form id="taskElementCreate" method="PUT" action="<?= \phpOMS\Uri\UriFactory::build('{/api}task/element?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tr><td><label for="iMessage"><?= $this->getHtml('Message') ?></label>
                        <tr><td><?= $this->getData('editor')->render('task-editor'); ?>
                        <tr><td><?= $this->getData('editor')->getData('text')->render(
                            'task-editor',
                            'plain',
                            'taskElementCreate',
                            '', '',
                            '/content', '{/api}task?id={?id}'
                            ); ?>
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
                        <tr><td><?= $this->getData('accGrpSelector')->render('iReceiver', 'to', true); ?>
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
