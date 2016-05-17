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
    <header><h1><?= $this->l11n->lang['Reporter']['Template'] ?></h1></header>
    <div class="inner">
        <form id="reporter-template-create" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/reporter/report/template'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td colspan="2"><label for="iTitle"><?= $this->l11n->lang['Reporter']['Title'] ?></label>
                <tr><td colspan="2"><input id="iTitle" name="name" type="text" placeholder="&#xf040; P&L Reporting" required>
                <tr><td colspan="2"><label for="iDescription"><?= $this->l11n->lang['Reporter']['Description'] ?></label>
                <tr><td colspan="2"><textarea id="iDescription" name="description"></textarea>
                <tr><td colspan="2"><h2><?= $this->l11n->lang['Reporter']['Storage'] ?></h2>
                <tr><td colspan="2">
                        <span class="radio">
                            <input id="iSourceDB" name="source" type="radio" value="<?= \Modules\Reporter\Models\TemplateDataType::GLOBAL_DB; ?>">
                            <label for="iSourceDB"><?= $this->l11n->lang['Reporter']['CentralizedDB'] ?></label>
                        </span>
                <tr><td colspan="2">
                        <span class="radio">
                            <input id="iSourceOther" name="source" type="radio" value="<?= \Modules\Reporter\Models\TemplateDataType::GLOBAL_FILE; ?>">
                            <label for="iSourceOther"><?= $this->l11n->lang['Reporter']['CentralizedFiles'] ?></label>
                        </span>
                <tr><td colspan="2">
                        <span class="radio">
                            <input id="iSourceOther" name="source" type="radio" value="<?= \Modules\Reporter\Models\TemplateDataType::OTHER; ?>" checked>
                            <label for="iSourceOther"><?= $this->l11n->lang['Reporter']['Other'] ?></label>
                        </span>
                <tr><td colspan="2"><label for="iFile"><?= $this->l11n->lang['Reporter']['Files'] ?></label>
                <tr><td colspan="2"><input id="iFile" name="fileVisual" type="file" required multiple><input id="iFileHidden" name="files" type="hidden">
                <tr><td colspan="2"><label for="iExpected"><?= $this->l11n->lang['Reporter']['Expected'] ?></label>
                <tr><td class="wf-100"><input id="iExpected" type="text" placeholder="&#xf15b; file.csv"><input name="expected" type="hidden"><td><button><?= $this->l11n->lang[0]['Add'] ?></button>
                <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Create'] ?>">
            </table>
        </form>
    </div>
</section>
