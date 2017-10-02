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
$project = $this->getData('project');
$tasks = $project->getTasks();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->printHtml($project->getName()); ?></h1></header>
            <div class="inner">
                <form id="fProject" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/projectmanagement?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iName"><?= $this->getHtml('Name') ?></label>
                        <tr><td colspan="2"><input type="text" id="iName" name="name" placeholder="&#xf007; Name" value="<?= $this->printHtml($project->getName()); ?>" required>
                        <tr><td><label for="iStart"><?= $this->getHtml('Start') ?></label>
                            <td><label for="iEnd"><?= $this->getHtml('End') ?></label>
                        <tr><td><input type="datetime-local" id="iStart" name="start" value="<?= $this->printHtml($project->getStart()->format('Y-m-d\TH:i:s')); ?>">
                            <td><input type="datetime-local" id="iEnd" name="end" value="<?= $this->printHtml($project->getEnd()->format('Y-m-d\TH:i:s')); ?>">
                        <tr><td colspan="2"><label for="iDescription"><?= $this->getHtml('Description') ?></label>
                        <tr><td colspan="2"><textarea id="iDescription" name="desc"><?= $this->printHtml($project->getDescription()); ?></textarea>
                        <tr><td colspan="2"><label for="iProgressType"><?= $this->getHtml('Progress') ?></label>
                        <tr><td><select id="iProgressType" name="progressType">
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::MANUAL; ?>"><?= $this->getHtml('Manual') ?>
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::LINEAR; ?>"><?= $this->getHtml('Linear') ?>
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::EXPONENTIAL; ?>"><?= $this->getHtml('Exponential') ?>
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::LOG; ?>"><?= $this->getHtml('Log') ?>
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::TASKS; ?>"><?= $this->getHtml('Tasks') ?>
                                </select>
                            <td><input type="text" id="iProgress" name="progress" value="<?= $project->getProgress(); ?>"<?= $project->getProgressType() !== \Modules\ProjectManagement\Models\ProgressType::MANUAL ? ' disabled' : ''; ?>>
                        <tr><td><label for="iBudget"><?= $this->getHtml('Budget') ?></label><td><label for="iActual"><?= $this->getHtml('Actual') ?></label>
                        <tr><td><input type="text" id="iBudget" name="budget" placeholder=""><td><input type="text" id="iActual" name="actual">
                        <tr><td colspan="2"><input type="submit" value="<?= $this->getHtml('Save', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getHtml('Tasks', 'Tasks') ?></caption>
                <thead>
                    <td><?= $this->getHtml('Status') ?>
                    <td><?= $this->getHtml('Due', 'Tasks') ?>
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
                        <td><a href="<?= $url; ?>"><span class="tag <?= $this->printHtml($color); ?>"><?= $this->getHtml('S' . $task->getStatus(), 'Tasks') ?></span></a>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($task->getDue()->format('Y-m-d H:i')); ?></a>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($task->getTitle()); ?></a>
                <?php endforeach; if($c == 0) : ?>
                <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>

<div class="row">
            <div id="calendar" class="m-calendar m-calendar-mini col-xs-12 col-md-6" draggable="true" data-action='[
                {
                    "listener": "click", "selector": "#calendar span.tag", "action": [
                        {"key": 1, "type": "dom.popup", "tpl": "calendar-event-popup-tpl", "aniIn": "fadeIn"}
                    ]
                }
            ]'>
                <div class="box wf-100">
                <ul class="weekdays green">
                    <li><?= $this->getHtml('Sunday', 'Calendar'); ?>
                    <li><?= $this->getHtml('Monday', 'Calendar'); ?>
                    <li><?= $this->getHtml('Tuesday', 'Calendar'); ?>
                    <li><?= $this->getHtml('Wednesday', 'Calendar'); ?>
                    <li><?= $this->getHtml('Thursday', 'Calendar'); ?>
                    <li><?= $this->getHtml('Friday', 'Calendar'); ?>
                    <li><?= $this->getHtml('Saturday', 'Calendar'); ?>
                </ul>
                <?php $current = $project->getCalendar()->getDate()->getMonthCalendar(0); $isActiveMonth = false;
                for($i = 0; $i < 6; $i++) : ?>
                <ul class="days">
                    <?php for($j = 0; $j < 7; $j++) : 
                        $isActiveMonth = ((int) $current[$i*7+$j]->format('d') === 1) ? !$isActiveMonth : $isActiveMonth; 
                    ?>
                        <?php if($isActiveMonth) :?>
                        <li class="day<?= $project->getCalendar()->hasEventOnDate($current[$i*7+$j]) ? ' has-event' : '';?>">
                            <div class="date"><?= $current[$i*7+$j]->format('d'); ?></div>
                                <?php else: ?>
                        <li class="day other-month<?= $project->getCalendar()->hasEventOnDate($current[$i*7+$j]) ? ' has-event' : '';?>">
                            <div class="date"><?= $current[$i*7+$j]->format('d'); ?></div>
                        <?php endif; ?>
                    <?php endfor; ?>
                    </li>
                </ul>
                <?php endfor;?>
                </div>
            </div>

    <div class="col-xs-12 col-md-6">
        <div class="box wf-100">
            <table class="table blue">
                <caption><?= $this->getHtml('Media', 'Media') ?></caption>
                <thead>
                    <td>
                    <td class="wf-100"><?= $this->getHtml('Name', 'Media') ?>
                    <td><?= $this->getHtml('Type', 'Media') ?>
                    <td><?= $this->getHtml('Size', 'Media') ?>
                    <td><?= $this->getHtml('Creator', 'Media') ?>
                    <td><?= $this->getHtml('Created', 'Media') ?>
                <tfoot>
                <tbody>
                    <?php $count = 0; $media = $project->getMedia(); foreach($media as $key => $value) : $count++;
                        $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/media/single?{?}&id=' . $value->getId()); 

                        $icon = '';
                        $extensionType = \phpOMS\System\File\FileUtils::getExtensionType($value->getExtension());

                        if($extensionType === \phpOMS\System\File\ExtensionType::CODE) {
                            $icon = 'file-code-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::TEXT) {
                            $icon = 'file-text-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::PRESENTATION) {
                           $icon = 'file-powerpoint-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::PDF) {
                            $icon = 'file-pdf-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::ARCHIVE) {
                            $icon = 'file-zip-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::AUDIO) {
                            $icon = 'file-audio-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::VIDEO) {
                            $icon = 'file-video-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::IMAGE) {
                            $icon = 'file-image-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::SPREADSHEET) {
                            $icon = 'file-excel-o';
                        } elseif($value->getExtension() === 'collection') {
                            $icon = 'folder-open-o';
                        } else {
                            $icon = 'file-o';
                        }
                        ?>
                        <tr data-href="<?= $url; ?>">
                            <td><a href="<?= $url; ?>"><i class="fa fa-<?= $this->printHtml($icon); ?>"></i></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getExtension()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getSize()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedBy()->getName1()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedAt()->format('Y-m-d H:i:s')); ?></a>
                        <?php endforeach; ?>
                        <?php if($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1>Finances</h1></header>
        </section>
    </div>
</div>