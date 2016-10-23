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
    <?php include __DIR__ . '/../../../Editor/Theme/Backend/editor.tpl.php'; ?>
</section>
<section class="wf-25 floatLeft">
    <section class="box w-100">
        <div class="inner">
            <form id="newsForm" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/news?csrf={$CSRF}'); ?>">
                <table class="layout wf-100">
                    <tr><td colspan="2"><label for="publish"><?= $this->getText('Status') ?></label>
                    <tr><td colspan="2"><select name="status">
                                <option value="<?= Modules\News\Models\NewsStatus::DRAFT; ?>" selected><?= $this->getText('Draft') ?>
                                <option value="<?= Modules\News\Models\NewsStatus::VISIBLE; ?>"><?= $this->getText('Visible') ?>
                    <tr><td colspan="2"><label for="publish"><?= $this->getText('Publish') ?></label>
                    <tr><td colspan="2"><input type="datetime-local" id="publish" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                    <tr><td><input type="submit" value="<?= $this->getText('Delete', 0) ?>"><td class="rightText"><input type="submit" value="<?= $this->getText('Save', 0) ?>"> <input type="submit" value="<?= $this->getText('Publish') ?>">
                </table>
            </form>
        </div>
    </section>
    <section class="box w-100">
        <div class="inner">
            <table class="layout wf-100">
                <tr><td colspan="2"><label><?= $this->getText('Type') ?></label>
                <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="newsForm" value="<?= Modules\News\Models\NewsType::ARTICLE; ?>" id="news" checked><label for="news"><?= $this->getText('News') ?></label></span>
                <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="newsForm" value="<?= Modules\News\Models\NewsType::HEADLINE; ?>" id="headline"><label for="headline"><?= $this->getText('Headline') ?></label></span>
                <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="newsForm" value="<?= Modules\News\Models\NewsType::LINK; ?>" id="link"><label for="link"><?= $this->getText('Link') ?></label></span>
            </table>
        </div>
    </section>
    <section class="box w-100">
        <div class="inner">
            <table class="layout wf-100">
                <tr><td><label for="permission"><?= $this->getText('Permissions') ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="permission"><input type="hidden" form="newsForm" name="permission"></span>
                <tr><td><button><?= $this->getText('Add', 0, 0) ?></button>
            </table>
        </div>
    </section>
    <section class="box w-100">
        <div class="inner">
            <table class="layout wf-100">
                <tr><td colspan="2"><label for="groups"><?= $this->getText('Groups') ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input  type="text" id="groups"><input type="hidden" form="newsForm" name="groups"></span>
                <tr><td><button><?= $this->getText('Add', 0, 0) ?></button>
            </table>
        </div>
    </section>
</section>
