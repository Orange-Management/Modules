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
 * @var \phpOMS\Views\View         $this
 * @var \Modules\Tasks\Models\Task $task
 */
$task      = $this->getData('task');
$elements  = $task->getTaskElements();
$cElements = count($elements);

$statusColor = '';
if($task->getStatus() === \Modules\Tasks\Models\TaskStatus::DONE) { $statusColor = 'green'; }
elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::OPEN) { $statusColor = 'darkblue'; }
elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::WORKING) { $statusColor = 'purple'; }
elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::CANCELED) { $statusColor = 'red'; }
elseif($task->getStatus() === \Modules\Tasks\Models\TaskStatus::SUSPENDED) { $statusColor = 'yellow'; }

$priorityColor = '';
if($task->getPriority() === \Modules\Tasks\Models\TaskPriority::VLOW) { $priorityColor = 'green'; }
elseif($task->getPriority() === \Modules\Tasks\Models\TaskPriority::LOW) { $priorityColor = 'blue'; }
elseif($task->getPriority() === \Modules\Tasks\Models\TaskPriority::MEDIUM) { $priorityColor = 'darkblue'; }
elseif($task->getPriority() === \Modules\Tasks\Models\TaskPriority::HIGH) { $priorityColor = 'yellow'; }
elseif($task->getPriority() === \Modules\Tasks\Models\TaskPriority::VHIGH) { $priorityColor = 'red'; }

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100 <?= $statusColor; ?>">
            <header><h1 id="taskTitleText" data-action='[
                            {
                                "listener": "click", "action": [
                                    {"type": "dom.hide", "id": "taskTitleText"},
                                    {"type": "dom.show", "id": "taskTitleInput"},
                                    {"type": "dom.focus", "id": "taskTitleInput"}
                                ]
                            }
                        ]'><?= $task->getTitle(); ?></h1><input type="text" id="taskTitleInput" class="vh" value="<?= $task->getTitle(); ?>"></header>
            <div class="inner">
                <div class="floatRight">
                    Due <?= $task->getDue()->format('Y-m-d H:i'); ?>
                    <span class="vCenterTable nobreak tag <?= $priorityColor; ?>"><?= $this->getText('P' . $task->getPriority()); ?></span>
                </div>
                <div>Created <?= $task->getCreatedAt()->format('Y-m-d H:i'); ?></div>
            </div>
            <div class="inner">
                <blockquote id="taskText" data-action='[
                            {
                                "listener": "click", "action": [
                                    {"type": "dom.hide", "id": "taskText"},
                                    {"type": "dom.show", "id": "taskTextArea"},
                                    {"type": "dom.focus", "id": "taskTextArea"}
                                ]
                            }
                        ]'><?= $task->getDescription(); ?></blockquote><textarea class="vh" id="taskTextArea"><?= $task->getDescription(); ?></textarea>
            </div>
            <div class="inner">
                <div class="pAlignTable nobreak">
                    <div class="vCenterTable wf-100">Created <?= $task->getCreatedBy(); ?></div>
                    <span class="vCenterTable nobreak tag <?= $statusColor; ?>"><?= $this->getText('S' . $task->getStatus()); ?></span>
                </div>
            </div>
        </section>

        <?php $c = 0;
        $previous = null;
        foreach ($elements as $key => $element) : $c++;
            if($element->getStatus() === \Modules\Tasks\Models\TaskStatus::DONE) { $statusColor = 'green'; }
            elseif($element->getStatus() === \Modules\Tasks\Models\TaskStatus::OPEN) { $statusColor = 'darkblue'; }
            elseif($element->getStatus() === \Modules\Tasks\Models\TaskStatus::WORKING) { $statusColor = 'purple'; }
            elseif($element->getStatus() === \Modules\Tasks\Models\TaskStatus::CANCELED) { $statusColor = 'red'; }
            elseif($element->getStatus() === \Modules\Tasks\Models\TaskStatus::SUSPENDED) { $statusColor = 'yellow'; } ?>
            <section class="box wf-100 <?= $statusColor; ?>">
                <div class="inner pAlignTable">
                    <div class="vCenterTable wf-100"><?= $element->getCreatedBy(); ?> - <?= $element->getCreatedAt()->format('Y-m-d H:i'); ?></div>
                    <span class="vCenterTable tag <?= $statusColor; ?>"><?= $this->getText('S' . $element->getStatus()); ?></span>
                </div>

            <?php if ($element->getDescription() !== '') : ?>
                    <div class="inner">
                        <blockquote id="elementText<?= $c; ?>" data-action='[
                            {
                                "listener": "click", "action": [
                                    {"type": "dom.hide", "id": "elementText<?= $c; ?>"},
                                    {"type": "dom.show", "id": "elementTextArea<?= $c; ?>"},
                                    {"type": "dom.focus", "id": "elementTextArea<?= $c; ?>"}
                                ]
                            }
                        ]'><?= $element->getDescription(); ?></blockquote><textarea class="vh" id="elementTextArea<?= $c; ?>"><?= $element->getDescription(); ?></textarea>
                    </div>
            <?php endif; ?>
                <div class="inner pAlignTable">
                <?php if ($element->getForwarded() !== 0) : ?>
                    <div class="vCenterTable wf-100">Forwarded <?= $element->getForwarded(); ?></div>
                <?php endif; ?>
            </section>
        <?php $previous = $element; endforeach; ?>

        <section class="box wf-100">
            <div class="inner">
                <form id="taskElementCreate" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/task/element?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tr><td><label for="iMessage"><?= $this->getText('Message'); ?></label>
                        <tr><td><?php //include __DIR__ . '/../../../Editor/Theme/Backend/inline-editor-tools.tpl.php'; ?>
                        <tr><td><textarea id="iMessage" name="description"></textarea>
                        <tr><td><label for="iStatus"><?= $this->getText('Status'); ?></label>
                        <tr><td><select id="iStatus" name="status">
                                    <option value="<?= \Modules\Tasks\Models\TaskStatus::OPEN; ?>"><?= $this->getText('S1'); ?>
                                    <option value="<?= \Modules\Tasks\Models\TaskStatus::WORKING; ?>" selected><?= $this->getText('S2'); ?>
                                    <option value="<?= \Modules\Tasks\Models\TaskStatus::SUSPENDED; ?>"><?= $this->getText('S3'); ?>
                                    <option value="<?= \Modules\Tasks\Models\TaskStatus::CANCELED; ?>"><?= $this->getText('S4'); ?>
                                    <option value="<?= \Modules\Tasks\Models\TaskStatus::DONE; ?>"><?= $this->getText('S5'); ?>
                                </select>
                        <tr><td colspan="2"><label for="iReceiver"><?= $this->getText('Forward'); ?></label>
                        <tr><td><span class="input"><button type="button" data-action='[
                            {
                                "listener": "click", "action": [
                                    {"type": "dom.popup", "tpl": "acc-grp-tpl", "aniIn": "fadeIn"},
                                    {"type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/account?filter=some&limit=10'); ?>", "method": "GET", "request_type": "json"},
                                    {"type": "dom.table.append", "id": "acc-grp-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1}
                                ]
                            }
                        ]' formaction=""><i class="fa fa-book"></i></button><input type="text" list="iReceiver-datalist" id="iReceiver" name="receiver" placeholder="&#xf007; Guest" data-action='[
                            {
                                "listener": "keyup", "action": [
                                    {"type": "utils.timer", "id": "iReceiver", "delay": 500, "resets": true},
                                    {"type": "dom.datalist.clear", "id": "iReceiver-datalist"},
                                    {"type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/account?search={#iReceiver}", "method": "GET", "request_type": "json"},
                                    {"type": "dom.datalist.append", "id": "iReceiver-datalist", "value": "id", "text": "name"}
                                ]
                            }
                        ]' required>
                        <datalist id="iReceiver-datalist"></datalist></span><td><button><?= $this->getText('Add', 0, 0); ?></button>
                        <tr><td colspan="2"><label for="iMedia"><?= $this->getText('Media'); ?></label>
                        <tr><td><input type="text" id="iMedia" placeholder="&#xf15b; File"><td><button><?= $this->getText('Select'); ?></button>
                        <tr><td colspan="2"><label for="iUpload"><?= $this->getText('Upload'); ?></label>
                        <tr><td><input type="file" id="iUpload" form="fTask"><input form="fTask" type="hidden" name="type"><td>
                        <tr><td><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>"><input type="hidden" name="task" value="<?= $this->request->getData('id') ?>"><input type="hidden" name="type" value="1">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>

<?php include __DIR__ . '/../../../Profile/Theme/Backend/acc-grp-popup.tpl.php'; ?>