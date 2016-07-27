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
 */
echo $this->getData('nav')->render(); ?>

<section class="box w-50 floatLeft">
    <header><h1><?= $this->l11n->getText('Tasks', 'Backend', 'Task'); ?></h1></header>

    <div class="inner">
        <form id="fTask"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/task/create'); ?>">
            <table class="layout wf-100">
                <tbody>
                <tr><td colspan="2"><label for="iReceiver"><?= $this->l11n->getText('Tasks', 'Backend', 'To'); ?></label>
                <tr><td><span class="input"><button type="button" data-action='[{"type": "popup", "tpl": "acc-grp-tpl", "aniIn": "fadeIn", "aniOut": "fadeOut", "stay": 5000}]' formaction=""><i class="fa fa-book"></i></button><input type="number" min="1" id="iReceiver" name="receiver" placeholder="&#xf007; Guest" required></span><td><button><?= $this->l11n->getText(0, 'Backend', 'Add'); ?></button>
                <tr><td colspan="2"><label for="iObserver"><?= $this->l11n->getText('Tasks', 'Backend', 'CC'); ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="number" min="1" id="iObserver" name="observer" placeholder="&#xf007; Guest" required></span><td><button><?= $this->l11n->getText(0, 'Backend', 'Add'); ?></button>
                <tr><td colspan="2"><label for="iDue"><?= $this->l11n->getText('Tasks', 'Backend', 'Due'); ?></label>
                <tr><td><input type="datetime-local" id="iDue" name="due" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>"><td>
                <tr><td colspan="2"><label for="iTitle"><?= $this->l11n->getText('Tasks', 'Backend', 'Title'); ?></label>
                <tr><td><input type="text" id="iTitle" name="title" placeholder="&#xf040; <?= $this->l11n->getText('Tasks', 'Backend', 'Title'); ?>"><td>
                <tr><td colspan="2"><label for="iMessage"><?= $this->l11n->getText('Tasks', 'Backend', 'Message'); ?></label>
                <tr><td><textarea id="iMessage" name="description" placeholder="&#xf040;"></textarea><td>
                <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->getText(0, 'Backend', 'Create'); ?>"><input type="hidden" name="type" value="<?= \Modules\Tasks\Models\TaskType::SINGLE; ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-50 floatLeft">
    <header><h1><?= $this->l11n->getText('Tasks', 'Backend', 'Media'); ?></h1></header>

    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tbody>
                <tr><td colspan="2"><label for="iMedia"><?= $this->l11n->getText('Tasks', 'Backend', 'Media'); ?></label>
                <tr><td><input type="text" id="iMedia" placeholder="&#xf15b; File"><td><button><?= $this->l11n->getText(0, 'Backend', 'Select'); ?></button>
                <tr><td colspan="2"><label for="iUpload"><?= $this->l11n->getText('Tasks', 'Backend', 'Upload'); ?></label>
                <tr><td><input type="file" id="iUpload" form="fTask"><input form="fTask" type="hidden" name="type"><td>
            </table>
        </form>
    </div>
</section>

<?php include ROOT_PATH . '/Modules/Profile/Theme/Backend/acc-grp-popup.tpl.php'; ?>