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
/**
 * @var \phpOMS\Views\View $this
 * @var \Modules\Tasks\Models\Task[] $tasks
 */
$tasks = $this->getData('tasks');
?>
<div id="task-dashboard" class="col-xs-12 col-md-6" draggable="true">
    <div class="box wf-100">
        <table class="table red">
            <caption><?= $this->getHtml('Tasks') ?></caption>
            <thead>
            <td><?= $this->getHtml('Status') ?>
            <td><?= $this->getHtml('Due') ?>
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
                <td><a href="<?= $url; ?>"><span class="tag <?= htmlspecialchars($color, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('S' . $task->getStatus()) ?></span></a>
                <td><a href="<?= $url; ?>"><?= htmlspecialchars($task->getDue()->format('Y-m-d H:i'), ENT_COMPAT, 'utf-8'); ?></a>
                <td><a href="<?= $url; ?>"><?= htmlspecialchars($task->getTitle(), ENT_COMPAT, 'utf-8'); ?></a>
                    <?php endforeach; if($c == 0) : ?>
            <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                    <?php endif; ?>
        </table>
    </div>
</div>