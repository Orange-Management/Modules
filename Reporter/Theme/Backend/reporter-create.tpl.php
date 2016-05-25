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
$templateList   = \Modules\Reporter\Models\TemplateMapper::listResults(
    \Modules\Reporter\Models\TemplateMapper::find('reporter_template.reporter_template_id',
                'reporter_template.reporter_template_title',
                'reporter_template.reporter_template_creator',
                'reporter_template.reporter_template_created')
            ->where('account_permission.account_permission_w', '=', 1)
    );

echo $this->getData('nav')->render(); ?>
<section class="box w-50 floatLeft">
    <header><h1><?= $this->l11n->lang['Reporter']['Report'] ?></h1></header>
    <div class="inner">
        <form id="reporter-report-create" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/reporter/report/report'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iTitle"><?= $this->l11n->lang['Reporter']['Title'] ?></label>
                <tr><td><input id="iTitle" name="name" type="text" placeholder="&#xf040; P&L Reporting 2015 December v1.0" required>
                <tr><td><label for="iTemplate"><?= $this->l11n->lang['Reporter']['Template'] ?></label>
                <tr><td><select id="iTemplate" name="template">
                            <?php foreach($templateList as $key => $value) : ?>
                            <option value="<?= $key; ?>"><?= $value->getName(); ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td><label for="iFile"><?= $this->l11n->lang['Reporter']['Files'] ?></label>
                <tr><td><input id="iFile" name="fileVisual" type="file" required multiple><input id="iFileHidden" name="files" type="hidden" pattern="\\[(([0-9])+(,)*( )*)+\\]" required>
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Create'] ?>">
            </table>
        </form>
    </div>
</section>
