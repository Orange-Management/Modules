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
?>
<div class="col-xs-12 col-md-6">
    <div class="box wf-100">
        <table class="table red">
            <caption><?= $this->getText('Tasks'); ?></caption>
            <thead>
            <td><?= $this->getText('Status'); ?>
            <td><?= $this->getText('Due'); ?>
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
                <td><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->getText('S' . $task->getStatus()); ?></span></a>
                <td><a href="<?= $url; ?>"><?= $task->getDue()->format('Y-m-d H:i'); ?></a>
                <td><a href="<?= $url; ?>"><?= $task->getTitle(); ?></a>
                    <?php endforeach; if($c == 0) : ?>
            <tr><td colspan="6" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                    <?php endif; ?>
        </table>
    </div>
</div>