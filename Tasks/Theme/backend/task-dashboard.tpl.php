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
/**
 * @var \phpOMS\Views\View $this
 * @var \Modules\Tasks\Models\Task[] $tasks
 */
$tasks = $this->getData('tasks');
echo $this->getData('nav')->render(); ?>

<div class="box w-75 floatLeft">
    <table class="table">
        <caption><?= $this->getText('Tasks'); ?></caption>
        <thead>
            <td><?= $this->getText('Status'); ?>
            <td><?= $this->getText('Due'); ?>
            <td class="full"><?= $this->getText('Title'); ?>
            <td><?= $this->getText('Creator'); ?>
            <td><?= $this->getText('Created'); ?>
        <tfoot>
        <tbody>
        <?php $c = 0; foreach($tasks as $key => $task) : $c++;
        $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/task/single?id=' . $task->getId());
        $color = 'darkred';
        if($task->getStatus() === \Modules\Tasks\Models\TaskStatus::DONE) { $color = 'green'; }
        elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::OPEN) { $color = 'darkblue'; }
        elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::WORKING) { $color = 'purple'; }
        elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::CANCELED) { $color = 'red'; }
        elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::SUSPENDED) { $color = 'yellow'; } ;?>
            <tr>
                <td><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->getText('S' . $task->getStatus()); ?></span></a>
                <td><a href="<?= $url; ?>"><?= $task->getDue()->format('Y-m-d H:i'); ?></a>
                <td><a href="<?= $url; ?>"><?= $task->getTitle(); ?></a>
                <td><a href="<?= $url; ?>"><?= $task->getCreatedBy(); ?></a>
                <td><a href="<?= $url; ?>"><?= $task->getCreatedAt()->format('Y-m-d H:i'); ?></a>
        <?php endforeach; if($c == 0) : ?>
        <tr><td colspan="6" class="empty"><?= $this->getText('Empty', 0, 0); ?>
        <?php endif; ?>
    </table>
</div>

<section class="w-25 floatLeft">
    <section class="box w-100">
        <header><h1><?= $this->getText('Settings'); ?></h1></header>
        <div class="inner">
            <form>
                <table class="layout wf-100">
                    <tr><td><label for="iIntervarl"><?= $this->getText('Interval'); ?></label>
                    <tr><td><select id="iIntervarl" name="interval">
                                <option><?= $this->getText('All'); ?>
                                <option><?= $this->getText('Day'); ?>
                                <option><?= $this->getText('Week'); ?>
                                <option selected><?= $this->getText('Month'); ?>
                                <option><?= $this->getText('Year'); ?>
                            </select>
                </table>
            </form>
        </div>
    </section>

    <section class="box w-100">
        <header><h1><?= $this->getText('Settings'); ?></h1></header>
        <div class="inner">
            <table class="list">
                <tr><th><?= $this->getText('Received'); ?><td>0
                <tr><th><?= $this->getText('Created'); ?><td>0
                <tr><th><?= $this->getText('Forwarded'); ?><td>0
                <tr><th><?= $this->getText('AverageAmount'); ?><td>0
                <tr><th><?= $this->getText('AverageProcessTime'); ?><td>0
                <tr><th><?= $this->getText('InTime'); ?><td>0
            </table>
        </div>
    </section>
</section>
