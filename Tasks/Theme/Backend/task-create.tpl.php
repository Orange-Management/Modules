<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Task') ?></h1></header>

            <div class="inner">
                <form id="fTask" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/task?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iReceiver"><?= $this->getHtml('To') ?></label>
                        <tr><td><?= $this->getData('accGrpSelector')->render('iReceiver'); ?><td><button><?= $this->getHtml('Add', 0, 0); ?></button>
                        <tr><td colspan="2"><label for="iObserver"><?= $this->getHtml('CC') ?></label>
                        <tr><td><?= $this->getData('accGrpSelector')->render('iCC'); ?><td><button><?= $this->getHtml('Add', 0, 0); ?></button>
                        <tr><td colspan="2"><label for="iPriority"><?= $this->getHtml('Priority') ?></label>
                        <tr><td><select id="iPriority" name="priority">
                                <option value="<?= htmlspecialchars(\Modules\Tasks\Models\TaskPriority::VLOW, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('P1') ?>
                                <option value="<?= htmlspecialchars(\Modules\Tasks\Models\TaskPriority::LOW, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('P2') ?>
                                <option value="<?= htmlspecialchars(\Modules\Tasks\Models\TaskPriority::MEDIUM, ENT_COMPAT, 'utf-8'); ?>" selected><?= $this->getHtml('P3') ?>
                                <option value="<?= htmlspecialchars(\Modules\Tasks\Models\TaskPriority::HIGH, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('P4') ?>
                                <option value="<?= htmlspecialchars(\Modules\Tasks\Models\TaskPriority::VHIGH, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('P5') ?>Done
                            </select><td>
                        <tr><td colspan="2"><label for="iDue"><?= $this->getHtml('Due') ?></label>
                        <tr><td><input type="datetime-local" id="iDue" name="due" value="<?= htmlspecialchars((new \DateTime('NOW'))->format('Y-m-d\TH:i:s') , ENT_COMPAT, 'utf-8'); ?>"><td>
                        <tr><td colspan="2"><label for="iTitle"><?= $this->getHtml('Title') ?></label>
                        <tr><td><input type="text" id="iTitle" name="title" placeholder="&#xf040; <?= $this->getHtml('Title') ?>" required><td>
                        <tr><td colspan="2"><label for="iMessage"><?= $this->getHtml('Message') ?></label>
                        <tr><td><?php //include __DIR__ . '/../../../Editor/Theme/Backend/inline-editor-tools.tpl.php'; ?>
                        <tr><td><textarea id="iMessage" name="description" placeholder="&#xf040;" required></textarea><td>
                        <tr><td colspan="2"><input type="submit" value="<?= $this->getHtml('Create', 0, 0); ?>"><input type="hidden" name="type" value="<?= htmlspecialchars(\Modules\Tasks\Models\TaskType::SINGLE, ENT_COMPAT, 'utf-8'); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Media') ?></h1></header>

            <div class="inner">
                <form>
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iMedia"><?= $this->getHtml('Media') ?></label>
                        <tr><td><input type="text" id="iMedia" placeholder="&#xf15b; File"><td><button><?= $this->getHtml('Select') ?></button>
                        <tr><td colspan="2"><label for="iUpload"><?= $this->getHtml('Upload') ?></label>
                        <tr><td><input type="file" id="iUpload" form="fTask"><input form="fTask" type="hidden" name="type"><td>
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>

<?= $this->getData('accGrpSelector')->getData('popup')->render(); ?>