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

use Modules\Tasks\Models\TaskPriority;

/**
 * @todo Orange-Management/Modules#176
 *  Batch handle tasks in the dashboard list
 *  In the dashboard/list it should be possible to change the status of a task without going into it (changing it to done is the most important).
 *  This could be done with a button but also touch sliding/swiping should be possible for mobile.
 *  It could also make sense to implement checkboxes infront of the list items which then show a close/done etc. button which can be pressed and changes the status of all of the checked tasks.
 */

 /**
 * @var \phpOMS\Views\View           $this
 * @var \Modules\Tasks\Models\Task[] $tasks
 */
$tasks = $this->getData('tasks');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100 x-overflow">
            <table id="taskList" class="default">
                <caption><?= $this->getHtml('Tasks') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                    <td><?= $this->getHtml('Status') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td><?= $this->getHtml('Due/Priority') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td class="full"><?= $this->getHtml('Title') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td><?= $this->getHtml('Creator') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td><?= $this->getHtml('Created') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                <tfoot>
                <tbody>
                <?php
                    $c = 0; foreach ($tasks as $key => $task) : ++$c;
                    $url = \phpOMS\Uri\UriFactory::build('{/prefix}task/single?{?}&id=' . $task->getId());
                ?>
                    <tr data-href="<?= $url; ?>">
                        <td data-label="<?= $this->getHtml('Status') ?>">
                            <a href="<?= $url; ?>">
                                <span class="tag <?= $this->printHtml('task-status-' . $task->getStatus()); ?>">
                                    <?= $this->getHtml('S' . $task->getStatus()) ?>
                                </span>
                            </a>
                        <td data-label="<?= $this->getHtml('Due/Priority') ?>">
                            <a href="<?= $url; ?>">
                            <?php if ($task->getPriority() === TaskPriority::NONE) : ?>
                                <?= $this->printHtml($task->getDue()->format('Y-m-d H:i')); ?>
                            <?php else : ?>
                                <?= $this->getHtml('P' . $task->getPriority()); ?>
                            <?php endif; ?>
                            </a>
                        <td data-label="<?= $this->getHtml('Title') ?>">
                            <a href="<?= $url; ?>"><?= $this->printHtml($task->getTitle()); ?></a>
                        <td data-label="<?= $this->getHtml('Creator') ?>">
                            <a href="<?= $url; ?>"><?= $this->printHtml($task->getCreatedBy()->getName1()); ?></a>
                        <td data-label="<?= $this->getHtml('Created') ?>">
                            <a href="<?= $url; ?>"><?= $this->printHtml($task->getCreatedAt()->format('Y-m-d H:i')); ?></a>
                <?php endforeach; if ($c == 0) : ?>
                    <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>