<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Department') ?></h1></header>
            <div class="inner">
                <form id="fDepartmentCreate" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/rootPath}{/lang}/api/organization/department'); ?>">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tr><td><label for="iName"><?= $this->getHtml('Name') ?></label>
                        <tr><td><input type="text" name="name" id="iName" placeholder="&#xf040; R&D" required>
                        <tr><td><label for="iParent"><?= $this->getHtml('Parent') ?></label>
                        <tr><td><?= $this->getData('department-selector')->render('iParent', false); ?>
                        <tr><td><label for="iUnit"><?= $this->getHtml('Unit') ?></label>
                        <tr><td><?= $this->getData('unit-selector')->render('iUnit', false); ?>
                        <tr><td><label for="iDescription"><?= $this->getHtml('Description') ?></label>
                        <tr><td><?= $this->getData('editor')->render('department-editor'); ?>
                        <tr><td><?= $this->getData('editor')->getData('text')->render('department-editor', 'description', 'fDepartmentCreate'); ?>
                        <tr><td><input id="iSubmit" name="submit" type="submit" value="<?= $this->getHtml('Create', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>

<?= $this->getData('department-selector')->getData('department-selector-popup')->render(); ?>
