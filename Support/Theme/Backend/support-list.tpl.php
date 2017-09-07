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
 * @var \Modules\Tasks\Models\Task[] $tickets
 */
$tickets = $this->getData('tasks');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-9">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getHtml('Tasks') ?></caption>
                <thead>
                    <td><?= $this->getHtml('Status') ?>
                    <td><?= $this->getHtml('Due') ?>
                    <td class="full"><?= $this->getHtml('Title') ?>
                    <td><?= $this->getHtml('Creator') ?>
                    <td><?= $this->getHtml('Created') ?>
                <tfoot>
                <tbody>
                <?php $c = 0; foreach($tickets as $key => $ticket) : $c++;
                $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/support/single?{?}&id=' . $ticket->getId());
                $color = 'darkred';
                if($ticket->getTask()->getStatus() === \Modules\Tasks\Models\TaskStatus::DONE) { $color = 'green'; }
                elseif($ticket->getTask()->getStatus() === \Modules\Tasks\Models\TaskStatus::OPEN) { $color = 'darkblue'; }
                elseif($ticket->getTask()->getStatus() === \Modules\Tasks\Models\TaskStatus::WORKING) { $color = 'purple'; }
                elseif($ticket->getTask()->getStatus() === \Modules\Tasks\Models\TaskStatus::CANCELED) { $color = 'red'; }
                elseif($ticket->getTask()->getStatus() === \Modules\Tasks\Models\TaskStatus::SUSPENDED) { $color = 'yellow'; } ?>
                    <tr data-href="<?= $url; ?>">
                        <td><a href="<?= $url; ?>"><span class="tag <?= htmlspecialchars($color, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('S' . $ticket->getTask()->getStatus()) ?></span></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($ticket->getTask()->getDue()->format('Y-m-d H:i'), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($ticket->getTask()->getTitle(), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($ticket->getTask()->getCreatedBy()->getName1(), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($ticket->getTask()->getCreatedAt()->format('Y-m-d H:i'), ENT_COMPAT, 'utf-8'); ?></a>
                <?php endforeach; if($c == 0) : ?>
                <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <div class="col-xs-12 col-md-3">
            <section class="box wf-100">
                <header><h1><?= $this->getHtml('Settings') ?></h1></header>
                <div class="inner">
                    <form>
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