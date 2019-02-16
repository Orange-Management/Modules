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
 * @var \Mouldes\Organization\Models $department;
 */
$department = $this->getData('department');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Department') ?></h1></header>
            <div class="inner">
                <form id="iDepartment" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/organization/department?{?}') ?>" method="POST">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tr><td><label for="iName"><?= $this->getHtml('Name') ?></label>
                        <tr><td><input type="text" name="name" id="iName" value="<?= $this->printHtml($department->getName()); ?>">
                        <tr><td><label for="iParent"><?= $this->getHtml('Parent') ?></label>
                        <tr><td><?= $this->getData('department-selector')->render('iParent', false); ?>
                        <tr><td><label for="iUnit"><?= $this->getHtml('Unit') ?></label>
                        <tr><td><?= $this->getData('unit-selector')->render('iUnit', false); ?>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status') ?></label>
                        <tr><td><select name="status" id="iStatus">
                                    <option><?= $this->getHtml('Active') ?>
                                    <option><?= $this->getHtml('Inactive') ?>
                                </select>
                        <tr><td><?= $this->getData('editor')->render('department-editor'); ?>
                        <tr><td><?= $this->getData('editor')->getData('text')->render(
                            'department-editor',
                            'description',
                            'iDepartment',
                            $department->getDescriptionRaw(),
                            $department->getDescription()
                        ); ?>
                        <tr><td><input id="iSubmit" name="submit" type="submit" value="<?= $this->getHtml('Save', 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>

<?= $this->getData('department-selector')->getData('department-selector-popup')->render(); ?>
