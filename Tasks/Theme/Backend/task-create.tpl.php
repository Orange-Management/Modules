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
 */
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Task'); ?></h1></header>

            <div class="inner">
                <form id="fTask" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/task?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iReceiver"><?= $this->getText('To'); ?></label>
                        <tr><td><span class="input"><button type="button" data-action='[
                            {
                                "listener": "click", "action": [
                                    {"type": "popup", "tpl": "acc-grp-tpl", "aniIn": "fadeIn"},
                                    {"type": "request", "uri": "<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/account?id=1'); ?>",  "method": "GET", "request_type": "json"}
                                ]
                            }
                        ]' formaction=""><i class="fa fa-book"></i></button><input type="number" min="1" id="iReceiver" name="receiver" placeholder="&#xf007; Guest" required></span><td><button><?= $this->getText('Add', 0, 0); ?></button>
                        <tr><td colspan="2"><label for="iObserver"><?= $this->getText('CC'); ?></label>
                        <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="number" min="1" id="iObserver" name="observer" placeholder="&#xf007; Guest"></span><td><button><?= $this->getText('Add', 0, 0); ?></button>
                        <tr><td colspan="2"><label for="iDue"><?= $this->getText('Due'); ?></label>
                        <tr><td><input type="datetime-local" id="iDue" name="due" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>"><td>
                        <tr><td colspan="2"><label for="iTitle"><?= $this->getText('Title'); ?></label>
                        <tr><td><input type="text" id="iTitle" name="title" placeholder="&#xf040; <?= $this->getText('Title'); ?>" required><td>
                        <tr><td colspan="2"><label for="iMessage"><?= $this->getText('Message'); ?></label>
                        <tr><td><textarea id="iMessage" name="description" placeholder="&#xf040;" required></textarea><td>
                        <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>"><input type="hidden" name="type" value="<?= \Modules\Tasks\Models\TaskType::SINGLE; ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Media'); ?></h1></header>

            <div class="inner">
                <form>
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iMedia"><?= $this->getText('Media'); ?></label>
                        <tr><td><input type="text" id="iMedia" placeholder="&#xf15b; File"><td><button><?= $this->getText('Select'); ?></button>
                        <tr><td colspan="2"><label for="iUpload"><?= $this->getText('Upload'); ?></label>
                        <tr><td><input type="file" id="iUpload" form="fTask"><input form="fTask" type="hidden" name="type"><td>
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>

<?php include __DIR__ . '/../../../Profile/Theme/Backend/acc-grp-popup.tpl.php'; ?>