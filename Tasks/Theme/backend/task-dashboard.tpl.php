<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
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
        <caption><?= $this->l11n->lang['Tasks']['Tasks']; ?></caption>
        <thead>
            <td><?= $this->l11n->lang['Tasks']['Status']; ?>
            <td><?= $this->l11n->lang['Tasks']['Due']; ?>
            <td class="full"><?= $this->l11n->lang['Tasks']['Title']; ?>
            <td><?= $this->l11n->lang['Tasks']['Creator']; ?>
            <td><?= $this->l11n->lang['Tasks']['Created']; ?>
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
                <td><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->l11n->lang['Tasks']['S' . $task->getStatus()]; ?></span></a>
                <td><a href="<?= $url; ?>"><?= $task->getDue()->format('Y-m-d H:i'); ?></a>
                <td><a href="<?= $url; ?>"><?= $task->getTitle(); ?></a>
                <td><a href="<?= $url; ?>"><?= $task->getCreatedBy(); ?></a>
                <td><a href="<?= $url; ?>"><?= $task->getCreatedAt()->format('Y-m-d H:i'); ?></a>
        <?php endforeach; if($c == 0) : ?>
        <tr><td colspan="6" class="empty"><?= $this->l11n->lang[0]['Empty']; ?>
        <?php endif; ?>
    </table>
</div>

<section class="w-25 floatLeft">
    <section class="box w-100">
        <header><h1><?= $this->l11n->lang['Tasks']['Settings']; ?></h1></header>
        <div class="inner">
            <form>
                <table class="layout wf-100">
                    <tr><td><label for="iIntervarl"><?= $this->l11n->lang['Tasks']['Interval']; ?></label>
                    <tr><td><select id="iIntervarl" name="interval">
                                <option><?= $this->l11n->lang['Tasks']['All']; ?>
                                <option><?= $this->l11n->lang['Tasks']['Day']; ?>
                                <option><?= $this->l11n->lang['Tasks']['Week']; ?>
                                <option selected><?= $this->l11n->lang['Tasks']['Month']; ?>
                                <option><?= $this->l11n->lang['Tasks']['Year']; ?>
                            </select>
                </table>
            </form>
        </div>
    </section>

    <section class="box w-100">
        <header><h1><?= $this->l11n->lang['Tasks']['Settings']; ?></h1></header>
        <div class="inner">
            <table class="list">
                <tr><th><?= $this->l11n->lang['Tasks']['Received']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['Created']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['Forwarded']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['AverageAmount']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['AverageProcessTime']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['InTime']; ?><td>0
            </table>
        </div>
    </section>
</section>
