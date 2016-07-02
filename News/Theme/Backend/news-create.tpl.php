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
    <section class="box w-100">
        <div class="inner">
            <input type="text" placeholder="&#xf040; This is a news title" form="newsForm">
        </div>
    </section>

    <section class="box w-100">
        <div class="inner">
            <i class="fa fa-header"></i>
            <i class="fa fa-link"></i>
            <i class="fa fa-image"></i>
            <i class="fa fa-bold"></i>
            <i class="fa fa-italic"></i>
            <i class="fa fa-underline"></i>
            <i class="fa fa-strikethrough"></i>
            <i class="fa fa-list-ol"></i>
            <i class="fa fa-list-ul"></i>
            <i class="fa fa-quote-right"></i>
            <i class="fa fa-subscript"></i>
            <i class="fa fa-superscript"></i>
            <i class="fa fa-question-circle floatRight"></i>
        </div>
    </section>

    <div class="box w-100">
        <div class="tabular">
            <ul class="tab-links">
                <li><label for="c-tab-1"><?= $this->l11n->getText('News', 'Plain') ?></label>
                <li><label for="c-tab-2"><?= $this->l11n->getText('News', 'Preview') ?></label>
            </ul>
            <div class="tab-content">
                <input type="radio" id="c-tab-1" name="tabular-1" checked>

                <div class="tab">
                    <textarea style="height: 300px" placeholder="&#xf040;" form="newsForm"></textarea><input type="hidden" id="iParsed" name="parsed">
                </div>
                <input type="radio" id="c-tab-2" name="tabular-1">

                <div class="tab">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wf-25 floatLeft">
    <section class="box w-100">
        <div class="inner">
            <form id="newsForm">
                <table class="layout wf-100">
                    <tr><td colspan="2"><label for="publish"><?= $this->l11n->getText('News', 'Status') ?></label>
                    <tr><td colspan="2"><select>
                                <option selected><?= $this->l11n->getText('News', 'Draft') ?>
                                <option><?= $this->l11n->getText('News', 'Visible') ?>
                    <tr><td colspan="2"><label for="publish"><?= $this->l11n->getText('News', 'Publish') ?></label>
                    <tr><td colspan="2"><input type="datetime-local" id="publish" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                    <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Delete') ?>"><td class="rightText"><input type="submit" value="<?= $this->l11n->lang[0]['Save'] ?>"> <input type="submit" value="<?= $this->l11n->getText('News', 'Publish') ?>">
                </table>
            </form>
        </div>
    </section>
    <section class="box w-100">
        <div class="inner">
            <form id="newsForm">
                <table class="layout wf-100">
                    <tr><td colspan="2"><label><?= $this->l11n->getText('News', 'Type') ?></label>
                    <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="newsForm" value="1" id="news" checked><label for="news"><?= $this->l11n->getText('News', 'News') ?></label></span>
                    <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="newsForm" value="2" id="headline"><label for="headline"><?= $this->l11n->getText('News', 'Headline') ?></label></span>
                    <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="newsForm" value="3" id="link"><label for="link"><?= $this->l11n->getText('News', 'Link') ?></label></span>
                </table>
            </form>
        </div>
    </section>
    <section class="box w-100">
        <div class="inner">
            <form id="newsForm">
                <table class="layout wf-100">
                    <tr><td><label for="permission"><?= $this->l11n->getText('News', 'Permissions') ?></label>
                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="permission"><input type="hidden" form="newsForm" name="permission"></span>
                    <tr><td><button><?= $this->l11n->getText(0, 'Add') ?></button>
                </table>
            </form>
        </div>
    </section>
    <section class="box w-100">
        <div class="inner">
            <form id="newsForm">
                <table class="layout wf-100">
                    <tr><td colspan="2"><label for="groups"><?= $this->l11n->getText('News', 'Groups') ?></label>
                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input  type="text" id="groups"><input type="hidden" form="newsForm" name="groups"></span>
                    <tr><td><button><?= $this->l11n->getText(0, 'Add') ?></button>
                </table>
            </form>
        </div>
    </section>
</section>
