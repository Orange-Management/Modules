<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    Modules\Admin\Template\Backend
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
    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Group'); ?></h1></header>
            <div class="inner">
                <form id="group-create" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="put" data-msg='{"title": "Some Title", "message": "My Message"}'>
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status'); ?></label>
                        <tr><td>
                                <select id="iStatus" name="status">
                                    <option value="<?= $this->printHtml(\phpOMS\Account\GroupStatus::ACTIVE); ?>" selected><?= $this->getHtml('Active'); ?>
                                    <option value="<?= $this->printHtml(\phpOMS\Account\GroupStatus::INACTIVE); ?>"><?= $this->getHtml('Inactive'); ?>
                                </select>
                        <tr><td><label for="iGname"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><input id="iGname" name="name" type="text" placeholder="&#xf0c0; Guest" required>
                        <tr><td><label for="iGroupDescription"><?= $this->getHtml('Description'); ?></label>
                        <tr><td><textarea id="iGroupDescription" name="description" placeholder="&#xf040;"></textarea>
                        <tr><td><input type="submit" id="iCreate" name="create" value="<?= $this->getHtml('Create', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <table class="box table red wf-100">
            <caption><?= $this->getHtml('Parents') ?></caption>
            <thead>
                <tr>
                    <td><?= $this->getHtml('ID', 0, 0); ?>
                    <td class="wf-100">Name
            <tbody>
                <?php $c = 0; foreach ([] as $key => $value) : $c++; ?>
                <tr>
                    <td>
                    <td>
                <?php endforeach; ?>
                <?php if ($c === 0) : ?>
                <tr><td colspan="2" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
        </table>

        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Parent'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iGParentName"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><input id="iGParentName" name="parentname" type="text" placeholder="&#xf0c0; Guest">
                        <tr><td><input type="submit" value="<?= $this->getHtml('Add', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <table class="box table red wf-100">
            <caption><?= $this->getHtml('Permissions') ?></caption>
            <thead>
                <tr>
                    <td><?= $this->getHtml('ID', 0, 0); ?>
                    <td>Unit
                    <td>App
                    <td>Module
                    <td>Type
                    <td>Ele.
                    <td>Comp.
                    <td class="wf-100">Perm.
            <tbody>
                <tr><td colspan="8" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
        </table>

        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Permissions'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iPermissionName"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><input id="iPermissionName" name="permissionname" type="text" placeholder="&#xf084; Admin">
                        <tr><td><input type="submit" value="<?= $this->getHtml('Add', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Accounts'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iGParentName"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><input id="iGParentName" name="parentname" type="text" placeholder="&#xf234; Donald Duck">
                        <tr><td><input type="submit" value="<?= $this->getHtml('Add', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>