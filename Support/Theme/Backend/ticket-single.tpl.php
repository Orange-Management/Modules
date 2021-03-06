<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Support
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View             $this
 * @var \Modules\Support\Models\Ticket $ticket
 */
$ticket      = $this->getData('ticket');
$elements  = $ticket->getTask()->getTaskElements();
$cElements = \count($elements);

if ($ticket->getTask()->getStatus() === \Modules\Tasks\Models\TaskStatus::OPEN) { $color = 'darkblue'; }
elseif ($ticket->getTask()->getStatus() === \Modules\Tasks\Models\TaskStatus::WORKING) { $color = 'purple'; }
elseif ($ticket->getTask()->getStatus() === \Modules\Tasks\Models\TaskStatus::CANCELED) { $color = 'red'; }
elseif ($ticket->getTask()->getStatus() === \Modules\Tasks\Models\TaskStatus::SUSPENDED) { $color = 'yellow'; }

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= $this->printHtml($ticket->getTask()->getTitle()); ?></h1></header>
            <div class="inner">
                <div class="floatRight">Due <?= $this->printHtml($ticket->getTask()->getDue()->format('Y-m-d H:i')); ?></div>
                <div>Created <?= $this->printHtml($ticket->getTask()->getCreatedAt()->format('Y-m-d H:i')); ?></div>
            </div>
            <div class="inner">
                <blockquote>
                    <?= $this->printHtml($ticket->getTask()->getDescription()); ?>
                </blockquote>
            </div>
            <div class="inner">
                <div class="pAlignTable">
                    <div class="vC wf-100">Created <?= $this->printHtml($ticket->getTask()->getCreatedBy()->getName1()); ?></div>
                    <span class="vC nobreak tag"><?= $this->getHtml('S' . $ticket->getTask()->getStatus()) ?></span>
                </div>
            </div>
        </section>

        <?php $c = 0;
        foreach ($elements as $key => $element) : ++$c;
            if ($element->getStatus() === \Modules\Tasks\Models\TaskStatus::DONE) { $color = 'green'; }
            elseif ($element->getStatus() === \Modules\Tasks\Models\TaskStatus::OPEN) { $color = 'darkblue'; }
            elseif ($element->getStatus() === \Modules\Tasks\Models\TaskStatus::WORKING) { $color = 'purple'; }
            elseif ($element->getStatus() === \Modules\Tasks\Models\TaskStatus::CANCELED) { $color = 'red'; }
            elseif ($element->getStatus() === \Modules\Tasks\Models\TaskStatus::SUSPENDED) { $color = 'yellow'; } ?>
            <section class="box wf-100">
                <div class="inner pAlignTable">
                    <div class="vC wf-100"><?= $this->printHtml($element->getCreatedBy()->getName1()); ?> - <?= $this->printHtml($element->getCreatedAt()->format('Y-m-d H:i')); ?></div>
                    <span class="vC tag <?= $this->printHtml($color); ?>"><?= $this->getHtml('S' . $element->getStatus()) ?></span>
                </div>

            <?php if ($element->getDescription() !== '') : ?>
                    <div class="inner">
                        <blockquote>
                            <?= $this->printHtml($element->getDescription()); ?>
                        </blockquote>
                    </div>
            <?php endif; ?>

                <div class="inner pAlignTable">
                <?php if ($element->getForwarded() !== 0) : ?>
                    <div class="vC wf-100">Forwarded <?= $this->printHtml($element->getForwarded()->getName1()); ?></div>
                <?php endif; ?>
                <?php if ($element->getStatus() !== \Modules\Tasks\Models\TaskStatus::CANCELED ||
                    $element->getStatus() !== \Modules\Tasks\Models\TaskStatus::DONE ||
                    $element->getStatus() !== \Modules\Tasks\Models\TaskStatus::SUSPENDED || $c != $cElements
                ) : ?>
                    <div class="vC nobreak">Due <?= $this->printHtml($element->getDue()->format('Y-m-d H:i')); ?></div>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>

        <section class="box wf-100">
            <div class="inner">
                <form id="taskElementCreate" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}task/element?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tr><td><label for="iMessage"><?= $this->getHtml('Message') ?></label>
                        <tr><td><textarea id="iMessage" name="description"></textarea>
                        <tr><td><label for="iDue"><?= $this->getHtml('Due') ?></label>
                        <tr><td><input type="datetime-local" id="iDue" name="due" value="<?= $this->printHtml(!empty($elements) ? \end($elements)->getDue()->format('Y-m-d\TH:i:s') : $ticket->getTask()->getDue()->format('Y-m-d\TH:i:s')); ?>">
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status') ?></label>
                        <tr><td><select id="iStatus" name="status">
                                    <option value="<?= $this->printHtml(\Modules\Tasks\Models\TaskStatus::OPEN); ?>" selected>Open
                                    <option value="<?= $this->printHtml(\Modules\Tasks\Models\TaskStatus::WORKING); ?>">Working
                                    <option value="<?= $this->printHtml(\Modules\Tasks\Models\TaskStatus::SUSPENDED); ?>">Suspended
                                    <option value="<?= $this->printHtml(\Modules\Tasks\Models\TaskStatus::CANCELED); ?>">Canceled
                                    <option value="<?= $this->printHtml(\Modules\Tasks\Models\TaskStatus::DONE); ?>">Done
                                </select>
                        <tr><td><label for="iReceiver"><?= $this->getHtml('To') ?></label>
                        <tr><td><input type="text" id="iReceiver" name="forward" value="<?= $this->printHtml($this->request->getHeader()->getAccount()); ?>" placeholder="&#xf007; Guest">
                        <tr><td colspan="2"><label for="iMedia"><?= $this->getHtml('Media') ?></label>
                        <tr><td><input type="text" id="iMedia" placeholder="&#xf15b; File"><td><button><?= $this->getHtml('Select') ?></button>
                        <tr><td colspan="2"><label for="iUpload"><?= $this->getHtml('Upload') ?></label>
                        <tr><td><input type="file" id="iUpload" form="fTask"><input form="fTask" type="hidden" name="type"><td>
                        <tr><td><input type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>"><input type="hidden" name="task" value="<?= $this->printHtml($this->request->getData('id')); ?>"><input type="hidden" name="type" value="1">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>
