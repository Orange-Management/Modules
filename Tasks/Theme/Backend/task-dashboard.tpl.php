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

 use Modules\Tasks\Models\TaskStatus;

/**
 * @var \phpOMS\Views\View           $this
 * @var \Modules\Tasks\Models\Task[] $tasks
 */
$tasks = $this->getData('tasks');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-9">
        <div class="box wf-100">
            <table id="taskList" class="table darkred">
                <caption><?= $this->getHtml('Tasks') ?></caption>
                <thead>
                    <td><?= $this->getHtml('Status') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td><?= $this->getHtml('Due/Priority') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td class="full"><?= $this->getHtml('Title') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td><?= $this->getHtml('Creator') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td><?= $this->getHtml('Created') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                <tfoot>
                <tbody>
                <?php $c = 0; foreach ($tasks as $key => $task) : $c++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/task/single?{?}&id=' . $task->getId());
                $color = 'darkred';
                if ($task->getStatus() === TaskStatus::DONE) { $color = 'green'; }
                elseif ($task->getStatus() === TaskStatus::OPEN) { $color = 'darkblue'; }
                elseif ($task->getStatus() === TaskStatus::WORKING) { $color = 'purple'; }
                elseif ($task->getStatus() === TaskStatus::CANCELED) { $color = 'red'; }
                elseif ($task->getStatus() === TaskStatus::SUSPENDED) { $color = 'yellow'; } ?>
                    <tr data-href="<?= $url; ?>">
                        <td data-label="<?= $this->getHtml('Status') ?>"><a href="<?= $url; ?>"><span class="tag <?= $this->printHtml($color); ?>"><?= $this->getHtml('S' . $task->getStatus()) ?></span></a>
                        <td data-label="<?= $this->getHtml('Due/Priority') ?>">
                            <a href="<?= $url; ?>">
                            <?php if ($task->getPriority() === \Modules\Tasks\Models\TaskPriority::NONE) : ?>
                                <?= $this->printHtml($task->getDue()->format('Y-m-d H:i')); ?>
                            <?php else : ?>
                                <?= $this->getHtml('P' . $task->getPriority()); ?>
                            <?php endif; ?>
                            </a>
                        <td data-label="<?= $this->getHtml('Title') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($task->getTitle()); ?></a>
                        <td data-label="<?= $this->getHtml('Creator') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($task->getCreatedBy()->getName1()); ?></a>
                        <td data-label="<?= $this->getHtml('Created') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($task->getCreatedAt()->format('Y-m-d H:i')); ?></a>
                <?php endforeach; if ($c == 0) : ?>
                <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <div class="col-xs-12 col-md-3">
            <section class="box wf-100">
                <header><h1><?= $this->getHtml('Settings') ?></h1></header>
                <div class="inner">
                    <form id="iTaskInterval" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/backend/task/dashboard?{?}') ?>" method="post">
                        <table class="layout wf-100">
                            <tr><td><label for="iIntervarl"><?= $this->getHtml('Interval') ?></label>
                            <tr><td><select id="iIntervarl" name="interval">
                                        <option><?= $this->getHtml('All') ?>
                                        <option><?= $this->getHtml('Day') ?>
                                        <option><?= $this->getHtml('Week') ?>
                                        <option selected><?= $this->getHtml('Month') ?>
                                        <option><?= $this->getHtml('Year') ?>
                                    </select>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box wf-100">
                <header><h1><?= $this->getHtml('Settings') ?></h1></header>
                <div class="inner">
                    <table class="list">
                        <tr><th><?= $this->getHtml('Received') ?><td>0
                        <tr><th><?= $this->getHtml('Created') ?><td>0
                        <tr><th><?= $this->getHtml('Forwarded') ?><td>0
                        <tr><th><?= $this->getHtml('AverageAmount') ?><td>0
                        <tr><th><?= $this->getHtml('AverageProcessTime') ?><td>0
                        <tr><th><?= $this->getHtml('InTime') ?><td>0
                    </table>
                </div>
            </section>
    </div>
</div>