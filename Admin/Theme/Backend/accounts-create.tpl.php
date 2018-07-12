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
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Account'); ?></h1></header>
            <div class="inner">
                <form id="fAccount" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/account'); ?>" method="put">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iType"><?= $this->getHtml('Type'); ?></label>
                        <tr><td><select id="*iType" name="type">
                                    <option value="<?= $this->printHtml(\phpOMS\Account\AccountType::USER); ?>"><?= $this->getHtml('Person'); ?>
                                    <option value="<?= $this->printHtml(\phpOMS\Account\AccountType::GROUP); ?>"><?= $this->getHtml('Organization'); ?>
                                </select>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status'); ?></label>
                        <tr><td><select id="iStatus" name="status">
                                    <option value="<?= $this->printHtml(\phpOMS\Account\AccountStatus::ACTIVE); ?>"><?= $this->getHtml('Active'); ?>
                                    <option value="<?= $this->printHtml(\phpOMS\Account\AccountStatus::INACTIVE); ?>"><?= $this->getHtml('Inactive'); ?>
                                    <option value="<?= $this->printHtml(\phpOMS\Account\AccountStatus::TIMEOUT); ?>"><?= $this->getHtml('Timeout'); ?>
                                    <option value="<?= $this->printHtml(\phpOMS\Account\AccountStatus::BANNED); ?>"><?= $this->getHtml('Banned'); ?>
                                </select>
                        <tr><td><label for="iUsername"><?= $this->getHtml('Username'); ?></label>
                        <tr><td><input id="iUsername" name="login" type="text" placeholder="&#xf007; Fred">
                        <tr><td><label for="iName1"><?= $this->getHtml('Name1'); ?></label>
                        <tr><td><input id="iName1" name="name1" type="text" placeholder="&#xf007; Donald" required>
                        <tr><td><label for="iName2"><?= $this->getHtml('Name2'); ?></label>
                        <tr><td><input id="iName2" name="name2" type="text" placeholder="&#xf007; Fauntleroy">
                        <tr><td><label for="iName3"><?= $this->getHtml('Name3'); ?></label>
                        <tr><td><input id="iName3" name="name3" type="text" placeholder="&#xf007; Duck">
                        <tr><td><label for="iEmail"><?= $this->getHtml('Email'); ?></label>
                        <tr><td><input id="iEmail" name="email" type="email" placeholder="&#xf0e0; d.duck@duckburg.com">
                        <tr><td><label for="iPassword"><?= $this->getHtml('Name3'); ?></label>
                        <tr><td><input id="iPassword" name="password" type="password" placeholder="&#xf023; Pa55ssw0rd?">
                        <tr><td><input id="account-create-submit" name="createSubmit" type="submit" value="<?= $this->getHtml('Create', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <table class="box table red">
            <caption><?= $this->getHtml('Groups') ?></caption>
            <thead>
                <tr>
                    <td><?= $this->getHtml('ID', 0, 0); ?>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
            <tbody>
                <tr><td colspan="2" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
        </table>

        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Groups'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iGroup"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><input id="iGroup" name="group" type="text" placeholder="&#xf0c0; Guest">
                        <tr><td><input type="submit" value="<?= $this->getHtml('Add', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <table class="box table red">
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
                        <tr><td><label for="iPermission"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><input id="iPermission" name="group" type="text" placeholder="&#xf084; news_create">
                        <tr><td><input type="submit" value="<?= $this->getHtml('Add', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>
