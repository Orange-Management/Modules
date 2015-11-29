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
    <h1><?= $this->l11n->lang['Tasks']['Task']; ?></h1>

    <div class="inner">
        <form id="fTask">
            <table class="layout wf-100">
                <tbody>
                <tr><td colspan="2"><label for="iReceiver"><?= $this->l11n->lang['Tasks']['To']; ?></label>
                <tr><td><input type="text" id="iReceiver" placeholder="&#xf007; Guest"><td><button><?= $this->l11n->lang[0]['Add']; ?></button>
                <tr><td colspan="2"><label for="iObserver"><?= $this->l11n->lang['Tasks']['CC']; ?></label>
                <tr><td><input type="text" id="iObserver" placeholder="&#xf007; Guest"><td><button><?= $this->l11n->lang[0]['Add']; ?></button>
                <tr><td colspan="2"><label for="iDue"><?= $this->l11n->lang['Tasks']['Due']; ?></label>
                <tr><td><input type="datetime-local" id="iDue" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>"><td>
                <tr><td colspan="2"><label for="iTitle"><?= $this->l11n->lang['Tasks']['Title']; ?></label>
                <tr><td><input type="text" id="iTitle" placeholder="&#xf040; <?= $this->l11n->lang['Tasks']['Title']; ?>"><td>
                <tr><td colspan="2"><label for="iMessage"><?= $this->l11n->lang['Tasks']['Message']; ?></label>
                <tr><td><textarea id="iMessage" placeholder="&#xf040;"></textarea><td>
                <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Create']; ?>"><input type="hidden" name="type" value="1">
            </table>
        </form>
    </div>
</section>

<section class="box w-50 floatLeft">
    <h1><?= $this->l11n->lang['Tasks']['Media']; ?></h1>

    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tbody>
                <tr><td colspan="2"><label for="iMedia"><?= $this->l11n->lang['Tasks']['Media']; ?></label>
                <tr><td><input type="text" id="iMedia" placeholder="&#xf15b; File"><td><button><?= $this->l11n->lang[0]['Select']; ?></button>
                <tr><td colspan="2"><label for="iUpload"><?= $this->l11n->lang['Tasks']['Upload']; ?></label>
                <tr><td><input type="file" id="iUpload" form="fTask"><input form="fTask" type="hidden" name="type"><td>
            </table>
        </form>
    </div>
</section>
