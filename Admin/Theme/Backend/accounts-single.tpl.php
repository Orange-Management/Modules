<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin\Template\Backend
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;
use phpOMS\Account\PermissionType;
use phpOMS\Uri\UriFactory;

/**
 * @todo Orange-Management/Modules#122
 *  Add group account removal
 *  In front of every account there should be a red x which allows to remove an account from the group.
 *
 * @todo Orange-Management/Modules#127
 *  Add account group removal
 *  Add red x in front of every group which removes the group for this account.
 *
 * @todo Orange-Management/Modules#126
 *  Add account log tab
 *  Add auditing log tab to accounts for whenever something changes for an account.
 *  This tab should show everything this user is doing and all places where he is mentioned.
 */

/**
 * @var \phpOMS\Views\View $this
 */
$account = $this->getData('account');
$permissions = $this->getData('permissions');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="portlet">
            <form id="account-edit" action="<?= UriFactory::build('{/api}admin/account'); ?>" method="post">
                <div class="portlet-head"><?= $this->getHtml('Account'); ?></div>
                <div class="portlet-body">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                        <tr><td><input id="iId" name="iaccount-idlist" type="text" value="<?= $this->printHtml($account->getId()); ?>" disabled>
                        <tr><td><label for="iType"><?= $this->getHtml('Type'); ?></label>
                        <tr><td><select id="iType" name="type">
                                    <option value="<?= $this->printHtml(AccountType::USER); ?>"<?= $this->printHtml($account->getType() === AccountType::USER ? ' selected' : ''); ?>><?= $this->getHtml('Person'); ?>
                                    <option value="<?= $this->printHtml(AccountType::GROUP); ?>"<?= $this->printHtml($account->getType() === AccountType::GROUP ? ' selected' : ''); ?>><?= $this->getHtml('Organization'); ?>
                                </select>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status'); ?></label>
                        <tr><td><select id="iStatus" name="status">
                                    <option value="<?= $this->printHtml(AccountStatus::ACTIVE); ?>"<?= $this->printHtml($account->getStatus() === AccountStatus::ACTIVE ? ' selected' : ''); ?>><?= $this->getHtml('Active'); ?>
                                    <option value="<?= $this->printHtml(AccountStatus::INACTIVE); ?>"<?= $this->printHtml($account->getStatus() === AccountStatus::INACTIVE ? ' selected' : ''); ?>><?= $this->getHtml('Inactive'); ?>
                                    <option value="<?= $this->printHtml(AccountStatus::TIMEOUT); ?>"<?= $this->printHtml($account->getStatus() === AccountStatus::TIMEOUT ? ' selected' : ''); ?>><?= $this->getHtml('Timeout'); ?>
                                    <option value="<?= $this->printHtml(AccountStatus::BANNED); ?>"<?= $this->printHtml($account->getStatus() === AccountStatus::BANNED ? ' selected' : ''); ?>><?= $this->getHtml('Banned'); ?>
                                </select>
                        <tr><td><label for="iUsername"><?= $this->getHtml('Username'); ?></label>
                        <tr><td>
                            <span class="input">
                                <button type="button"><i class="fa fa-user"></i></button>
                                <input id="iUsername" name="name" type="text" value="<?= $this->printHtml($account->getName()); ?>">
                            </span>
                        <tr><td><label for="iName1"><?= $this->getHtml('Name1'); ?></label>
                        <tr><td>
                            <span class="input">
                                <button type="button"><i class="fa fa-user"></i></button>
                                <input id="iName1" name="name1" type="text" value="<?= $this->printHtml($account->getName1()); ?>" required>
                            </span>
                        <tr><td><label for="iName2"><?= $this->getHtml('Name2'); ?></label>
                        <tr><td>
                            <span class="input">
                                <button type="button"><i class="fa fa-user"></i></button>
                                <input id="iName2" name="name2" type="text" value="<?= $this->printHtml($account->getName2()); ?>">
                            </span>
                        <tr><td><label for="iName3"><?= $this->getHtml('Name3'); ?></label>
                        <tr><td>
                            <span class="input">
                                <button type="button"><i class="fa fa-user"></i></button>
                                <input id="iName3" name="name3" type="text" value="<?= $this->printHtml($account->getName3()); ?>">
                            </span>
                        <tr><td><label for="iEmail"><?= $this->getHtml('Email'); ?></label>
                        <tr><td>
                            <span class="input">
                                <button type="button"><i class="fa fa-envelope-o"></i></button>
                                <input id="iEmail" name="email" type="email" value="<?= $this->printHtml($account->getEmail()); ?>">
                            </span>
                        <tr><td><label for="iPassword"><?= $this->getHtml('Password'); ?></label>
                        <tr><td>
                            <div class="ipt-wrap">
                                <div class="ipt-first">
                                    <span class="input">
                                        <button type="button"><i class="fa fa-lock"></i></button>
                                        <input id="iPassword" name="password" type="password">
                                    </span>
                                </div>
                                <div class="ipt-second"> or <button><?= $this->getHtml('Reset'); ?></button></div>
                        </div>
                    </table>
                </div>
                <div class="portlet-foot">
                    <input id="account-edit-submit" name="editSubmit" type="submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                    <button id="account-profile-create" data-action='[
                        {
                            "key": 1, "listener": "click", "action": [
                                {"key": 1, "type": "event.prevent"},
                                {"key": 2, "type": "dom.getvalue", "base": "", "selector": "#iId"},
                                {"key": 3, "type": "message.request", "uri": "{/base}/{/lang}/api/profile", "method": "PUT", "request_type": "json"},
                                {"key": 4, "type": "message.log"}
                            ]
                        }
                    ]'><?= $this->getHtml('CreateProfile'); ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Groups') ?><i class="fa fa-download floatRight download btn"></i></div>
            <table id="groupTable" class="default">
                <thead>
                    <tr>
                        <td>
                        <td><?= $this->getHtml('ID', '0', '0'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                        <td class="wf-100"><?= $this->getHtml('Name') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                <tbody>
                    <?php $c = 0; $groups = $account->getGroups(); foreach ($groups as $key => $value) : ++$c;
                    $url = UriFactory::build('{/prefix}admin/group/settings?{?}&id=' . $value->getId()); ?>
                    <tr data-href="<?= $url; ?>">
                        <td><a href="#"><i class="fa fa-times"></i></a>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
                    <?php endforeach; ?>
                    <?php if ($c === 0) : ?>
                    <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                    <?php endif; ?>
            </table>
        </div>

        <div class="portlet">
            <form id="iAddGroupToAccount" action="<?= UriFactory::build('{/api}admin/account/group'); ?>" method="put">
                <div class="portlet-head"><?= $this->getHtml('Groups'); ?></div>
                <div class="portlet-body">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iGroup"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><?= $this->getData('grpSelector')->render('iGroup', true); ?>
                    </table>
                </div>
                <div class="portlet-foot">
                    <input name="account" type="hidden" value="<?= $this->printHtml($account->getId()); ?>">
                    <input type="submit" value="<?= $this->getHtml('Add', '0', '0'); ?>">
                </div>
            </form>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Permissions') ?><i class="fa fa-download floatRight download btn"></i></div>
            <table class="default">
                <thead>
                    <tr>
                        <td>
                        <td>
                        <td><?= $this->getHtml('ID', '0', '0'); ?>
                        <td><?= $this->getHtml('Unit'); ?>
                        <td><?= $this->getHtml('App'); ?>
                        <td><?= $this->getHtml('Module'); ?>
                        <td><?= $this->getHtml('Type'); ?>
                        <td><?= $this->getHtml('Ele'); ?>
                        <td><?= $this->getHtml('Comp'); ?>
                        <td class="wf-100"><?= $this->getHtml('Perm'); ?>
                <tbody>
                    <?php $c = 0; foreach ($permissions as $key => $value) : ++$c; $permission = $value->getPermission(); ?>
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
                            <?= (PermissionType::CREATE | $permission) === $permission ? 'C' : ''; ?>
                            <?= (PermissionType::READ | $permission) === $permission ? 'R' : ''; ?>
                            <?= (PermissionType::MODIFY | $permission) === $permission ? 'U' : ''; ?>
                            <?= (PermissionType::DELETE | $permission) === $permission ? 'D' : ''; ?>
                            <?= (PermissionType::PERMISSION | $permission) === $permission ? 'P' : ''; ?>
                    <?php endforeach; ?>
                    <?php if ($c === 0) : ?>
                    <tr><td colspan="10" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                    <?php endif; ?>
            </table>
        </div>

        <div class="portlet">
            <form id="fAccountAddPermission" action="<?= UriFactory::build('{/api}admin/account/permission'); ?>" method="put">
            <div class="portlet-head"><?= $this->getHtml('Permissions'); ?></div>
            <div class="portlet-body">
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
                                <input id="iPermissionCreate" name="permissioncreate" type="checkbox" value="<?= PermissionType::CREATE ?>">
                                <label for="iPermissionCreate"><?= $this->getHtml('Create') ?></label>
                            </span>
                            <span class="checkbox">
                                <input id="iPermissionRead" name="permissionread" type="checkbox" value="<?= PermissionType::READ ?>">
                                <label for="iPermissionRead"><?= $this->getHtml('Read') ?></label>
                            </span>
                            <span class="checkbox">
                                <input id="iPermissionUpdate" name="permissionupdate" type="checkbox" value="<?= PermissionType::MODIFY ?>">
                                <label for="iPermissionUpdate"><?= $this->getHtml('Update') ?></label>
                            </span>
                            <span class="checkbox">
                                <input id="iPermissionDelete" name="permissiondelete" type="checkbox" value="<?= PermissionType::DELETE ?>">
                                <label for="iPermissionDelete"><?= $this->getHtml('Delete') ?></label>
                            </span>
                            <span class="checkbox">
                                <input id="iPermissionPermission" name="permissionpermission" type="checkbox" value="<?= PermissionType::PERMISSION ?>">
                                <label for="iPermissionPermission"><?= $this->getHtml('Permission') ?></label>
                            </span>
                    </table>
                </div>
                <div class="portlet-foot">
                    <input type="hidden" name="permissionref" value="<?= $this->printHtml($account->getId()); ?>">
                    <input type="hidden" name="permissionowner" value="<?= \phpOMS\Account\PermissionOwner::ACCOUNT ?>">
                    <input type="submit" value="<?= $this->getHtml('Add', '0', '0'); ?>">
                </div>
            </form>
        </div>
    </div>
</div>