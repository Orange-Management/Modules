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

<section class="wf-75 floatLeft">
    <?php include __DIR__ . '/../Editor/Theme/Backend/editor.tpl.php'; ?>
</section>
<section class="wf-25 floatLeft">
    <section class="box w-100">
        <div class="inner">
            <form id="newsForm">
                <table class="layout wf-100">
                    <tr><td colspan="2"><label for="publish"><?= $this->l11n->getText('News', 'Backend', 'Status') ?></label>
                    <tr><td colspan="2"><select>
                                <option selected><?= $this->l11n->getText('News', 'Backend', 'Draft') ?>
                                <option><?= $this->l11n->getText('News', 'Backend', 'Visible') ?>
                    <tr><td colspan="2"><label for="publish"><?= $this->l11n->getText('News', 'Backend', 'Publish') ?></label>
                    <tr><td colspan="2"><input type="datetime-local" id="publish" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                    <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Backend', 'Delete') ?>"><td class="rightText"><input type="submit" value="<?= $this->l11n->lang[0]['Save'] ?>"> <input type="submit" value="<?= $this->l11n->getText('News', 'Backend', 'Publish') ?>">
                </table>
            </form>
        </div>
    </section>
    <section class="box w-100">
        <div class="inner">
            <form id="newsForm">
                <table class="layout wf-100">
                    <tr><td colspan="2"><label><?= $this->l11n->getText('News', 'Backend', 'Type') ?></label>
                    <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="newsForm" value="1" id="news" checked><label for="news"><?= $this->l11n->getText('News', 'Backend', 'News') ?></label></span>
                    <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="newsForm" value="2" id="headline"><label for="headline"><?= $this->l11n->getText('News', 'Backend', 'Headline') ?></label></span>
                    <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="newsForm" value="3" id="link"><label for="link"><?= $this->l11n->getText('News', 'Backend', 'Link') ?></label></span>
                </table>
            </form>
        </div>
    </section>
    <section class="box w-100">
        <div class="inner">
            <form id="newsForm">
                <table class="layout wf-100">
                    <tr><td><label for="permission"><?= $this->l11n->getText('News', 'Backend', 'Permissions') ?></label>
                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="permission"><input type="hidden" form="newsForm" name="permission"></span>
                    <tr><td><button><?= $this->l11n->getText(0, 'Backend', 'Add') ?></button>
                </table>
            </form>
        </div>
    </section>
    <section class="box w-100">
        <div class="inner">
            <form id="newsForm">
                <table class="layout wf-100">
                    <tr><td colspan="2"><label for="groups"><?= $this->l11n->getText('News', 'Backend', 'Groups') ?></label>
                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input  type="text" id="groups"><input type="hidden" form="newsForm" name="groups"></span>
                    <tr><td><button><?= $this->l11n->getText(0, 'Backend', 'Add') ?></button>
                </table>
            </form>
        </div>
    </section>
</section>
