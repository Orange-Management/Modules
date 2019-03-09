<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
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
$group       = $this->getData('group');
$permissions = $this->getData('permissions');
$accounts    = $group->getAccounts();

echo $this->getData('nav')->render(); ?>

<div class="tabview tab-2">
    <div class="box wf-100 col-xs-12">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('General'); ?></label></li>
            <li><label for="c-tab-2"><?= $this->getHtml('AuditLog'); ?></label></li>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Group'); ?></h1></header>
                        <div class="inner">
                            <form id="fGroupEdit" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/group'); ?>" method="post">
                                <label for="iGid"><?= $this->getHtml('ID', 0, 0); ?></label>
                                <input id="iGid" name="id" type="text" value="<?= $this->printHtml($group->getId()); ?>" disabled>
                                <label for="iGname"><?= $this->getHtml('Name'); ?></label>
                                <input id="iGname" name="name" type="text" placeholder="&#xf0c0; Guest" value="<?= $this->printHtml($group->getName()); ?>">
                                <label for="iGstatus"><?= $this->getHtml('Status'); ?></label>
                                <select id="iGstatus" name="status">
                                    <?php $status = \phpOMS\Account\GroupStatus::getConstants(); foreach ($status as $stat) : ?>
                                    <option value="<?= $stat; ?>"<?= $stat === $group->getStatus() ? ' selected' : ''; ?>><?= $this->getHtml('GroupStatus' . $stat); ?>
                                <?php endforeach; ?>
                                    </select>
                                <?= $this->getData('editor')->render('group-editor'); ?>
                                <?= $this->getData('editor')->getData('text')->render(
                                    'group-editor',
                                    'description',
                                    'fGroupEdit',
                                    $group->getDescriptionRaw(),
                                    $group->getDescription()
                                ); ?>
                                <input id="groupSubmit" name="groupsubmit" type="submit" value="<?= $this->getHtml('Save', 0, 0); ?>">
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-6">
                    <table class="box table darkred wf-100">
                        <caption><?= $this->getHtml('Accounts') ?><i class="fa fa-download floatRight download btn"></i></caption>
                        <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', 0, 0); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td class="wf-100"><?= $this->getHtml('Name'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                        <tbody>
                            <?php $c = 0; foreach ($accounts as $key => $value) : $c++; ?>
                            <tr>
                                <td><a href="#"><i class="fa fa-times"></i></a>
                                <td><a href="<?= \phpOMS\Uri\UriFactory::build('{/prefix}admin/account/settings?{?}&id=' . $value->getId()) ?>"><?= $value->getName1(); ?></a>
                            <?php endforeach; ?>
                            <?php if ($c === 0) : ?>
                            <tr><td colspan="2" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                            <?php endif; ?>
                    </table>

                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Accounts'); ?></h1></header>
                        <div class="inner">
                            <form id="iAddAccountToGroup" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/group/account'); ?>" method="put">
                                <label for="iAccount"><?= $this->getHtml('Name'); ?></label>
                                <?= $this->getData('accGrpSelector')->render('iAccount', 'group', true); ?>
                                <input type="submit" value="<?= $this->getHtml('Add', 0, 0); ?>">
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-6">
                    <table id="groupPermissions" class="box table darkred wf-100">
                        <caption><?= $this->getHtml('Permissions') ?><i class="fa fa-download floatRight download btn"></i></caption>
                        <thead>
                            <tr>
                                <td>
                                <td>
                                <td><?= $this->getHtml('ID', 0, 0); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td><?= $this->getHtml('Unit'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td><?= $this->getHtml('App'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td><?= $this->getHtml('Module'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td><?= $this->getHtml('Type'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td><?= $this->getHtml('Ele'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td><?= $this->getHtml('Comp'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td class="wf-100"><?= $this->getHtml('Perm'); ?>
                        <tbody>
                            <?php $c = 0; foreach ($permissions as $key => $value) : $c++; $permission = $value->getPermission(); ?>
                            <tr>
                                <td><a href="#"><i class="fa fa-times"></i></a>
                                <td><a href="#"><i class="fa fa-cogs"></i></a>
                                <td><?= $value->getId(); ?>
                                <td><?= $value->getUnit(); ?>
                                <td><?= $value->getApp(); ?>
                                <td><?= $value->getModule(); ?>
                                <td><?= $value->getType(); ?>
                                <td><?= $value->getElement(); ?>
                                <td><?= $value->getComponent(); ?>
                                <td>
                                    <?= (\phpOMS\Account\PermissionType::CREATE | $permission) === $permission ? 'C' : ''; ?>
                                    <?= (\phpOMS\Account\PermissionType::READ | $permission) === $permission ? 'R' : ''; ?>
                                    <?= (\phpOMS\Account\PermissionType::MODIFY | $permission) === $permission ? 'U' : ''; ?>
                                    <?= (\phpOMS\Account\PermissionType::DELETE | $permission) === $permission ? 'D' : ''; ?>
                                    <?= (\phpOMS\Account\PermissionType::PERMISSION | $permission) === $permission ? 'P' : ''; ?>
                            <?php endforeach; ?>
                            <?php if ($c === 0) : ?>
                            <tr><td colspan="10" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                            <?php endif; ?>
                    </table>

                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Permissions'); ?></h1></header>
                        <div class="inner">
                            <form id="fGroupAddPermission" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/group/permission'); ?>" method="put">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iPermissionUnit"><?= $this->getHtml('Unit'); ?></label>
                                    <tr><td><input id="iPermissionUnit" name="permissionunit" type="text">
                                    <tr><td><label for="iPermissionApp"><?= $this->getHtml('App'); ?></label>
                                    <tr><td><input id="iPermissionApp" name="permissionapp" type="text">
                                    <tr><td><label for="iPermissionModule"><?= $this->getHtml('Module'); ?></label>
                                    <tr><td><input id="iPermissionModule" name="permissionmodule" type="text">
                                    <tr><td><label for="iPermissionType"><?= $this->getHtml('Type'); ?></label>
                                    <tr><td><input id="iPermissionType" name="permissiontype" type="text">
                                    <tr><td><label for="iPermissionElement"><?= $this->getHtml('Element'); ?></label>
                                    <tr><td><input id="iPermissionElement" name="permissionelement" type="text">
                                    <tr><td><label for="iPermissionComponent"><?= $this->getHtml('Component'); ?></label>
                                    <tr><td><input id="iPermissionComponent" name="permissioncomponent" type="text">
                                    <tr><td><label><?= $this->getHtml('Permission'); ?></label>
                                    <tr><td>
                                        <span class="checkbox">
                                            <input id="iPermissionCreate" name="permissioncreate" type="checkbox" value="<?= \phpOMS\Account\PermissionType::CREATE ?>">
                                            <label for="iPermissionCreate"><?= $this->getHtml('Create') ?></label>
                                        </span>
                                        <span class="checkbox">
                                            <input id="iPermissionRead" name="permissionread" type="checkbox" value="<?= \phpOMS\Account\PermissionType::READ ?>">
                                            <label for="iPermissionRead"><?= $this->getHtml('Read') ?></label>
                                        </span>
                                        <span class="checkbox">
                                            <input id="iPermissionUpdate" name="permissionupdate" type="checkbox" value="<?= \phpOMS\Account\PermissionType::MODIFY ?>">
                                            <label for="iPermissionUpdate"><?= $this->getHtml('Update') ?></label>
                                        </span>
                                        <span class="checkbox">
                                            <input id="iPermissionDelete" name="permissiondelete" type="checkbox" value="<?= \phpOMS\Account\PermissionType::DELETE ?>">
                                            <label for="iPermissionDelete"><?= $this->getHtml('Delete') ?></label>
                                        </span>
                                        <span class="checkbox">
                                            <input id="iPermissionPermission" name="permissionpermission" type="checkbox" value="<?= \phpOMS\Account\PermissionType::PERMISSION ?>">
                                            <label for="iPermissionPermission"><?= $this->getHtml('Permission') ?></label>
                                        </span>
                                    <tr><td>
                                        <input type="hidden" name="permissionref" value="<?= $this->printHtml($group->getId()); ?>">
                                        <input type="hidden" name="permissionowner" value="<?= \phpOMS\Account\PermissionOwner::GROUP ?>">
                                        <input type="submit" value="<?= $this->getHtml('Add', 0, 0); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <table class="box table darkred wf-100">
                        <caption><?= $this->getHtml('AuditLog') ?><i class="fa fa-download floatRight download btn"></i></caption>
                        <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', 0, 0); ?>
                                <td class="wf-100">Name
                        <tbody>
                            <?php $c = 0; foreach ([] as $key => $value) : $c++; ?>
                            <tr>
                                <td><a href="#"><i class="fa fa-times"></i></a>
                                <td>
                                <td>
                            <?php endforeach; ?>
                            <?php if ($c === 0) : ?>
                            <tr><td colspan="2" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                            <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>