<?php declare(strict_types=1);
use Modules\Tasks\Models\TaskPriority;
use Modules\Tasks\Models\TaskStatus;

?>
<table class="default">
    <caption><?= $this->getHtml('Tasks', 'Tasks') ?><i class="fa fa-download floatRight download btn"></i></caption>
    <thead>
        <td><?= $this->getHtml('Status', 'Tasks') ?>
        <td><?= $this->getHtml('Due/Priority', 'Tasks') ?>
        <td class="full"><?= $this->getHtml('Title', 'Tasks') ?>
    <tfoot>
    <tbody>
    <?php $c = 0; foreach ($this->tasks as $key => $task) : ++$c;
    $url = \phpOMS\Uri\UriFactory::build('{/prefix}task/single?{?}&id=' . $task->getId());
    $color = 'darkred';
    if ($task->getStatus() === TaskStatus::DONE) { $color = 'green'; }
    elseif ($task->getStatus() === TaskStatus::OPEN) { $color = 'darkblue'; }
    elseif ($task->getStatus() === TaskStatus::WORKING) { $color = 'purple'; }
    elseif ($task->getStatus() === TaskStatus::CANCELED) { $color = 'red'; }
    elseif ($task->getStatus() === TaskStatus::SUSPENDED) { $color = 'yellow'; } ?>
        <tr data-href="<?= $url; ?>">
            <td><a href="<?= $url; ?>"><span class="tag <?= $this->printHtml($color); ?>"><?= $this->getHtml('S' . $task->getStatus(), 'Tasks') ?></span></a>
            <td><a href="<?= $url; ?>">
                <?php if ($task->getPriority() === TaskPriority::NONE) : ?>
                    <?= $this->printHtml($task->getDue()->format('Y-m-d H:i')); ?>
                <?php else : ?>
                    <?= $this->getHtml('P' . $task->getPriority()); ?>
                <?php endif; ?>
                </a>
            <td><a href="<?= $url; ?>"><?= $this->printHtml($task->getTitle()); ?></a>
    <?php endforeach; if ($c == 0) : ?>
    <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
    <?php endif; ?>
</table>