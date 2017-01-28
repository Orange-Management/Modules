<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/*
 * UI Logic
 */

$account = $this->getData('account');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Account') ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/account'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iId"><?= $this->getText('ID', 0, 0) ?></label>
                        <tr><td><input id="iId" name="id" type="text" value="<?= $account->getId(); ?>" disabled>
                        <tr><td><label for="iType"><?= $this->getText('Type') ?></label>
                        <tr><td><select id="iType" name="type">
                                    <option value="<?= \phpOMS\Account\AccountType::USER; ?>"<?= $account->getType() === \phpOMS\Account\AccountType::USER ? ' selected' : ''; ?>><?= $this->getText('Person') ?>
                                    <option value="<?= \phpOMS\Account\AccountType::GROUP; ?>"<?= $account->getType() === \phpOMS\Account\AccountType::GROUP ? ' selected' : ''; ?>><?= $this->getText('Organization') ?>
                                </select>
                        <tr><td><label for="iStatus"><?= $this->getText('Status') ?></label>
                        <tr><td><select id="iStatus" name="status">
                                    <option value="<?= \phpOMS\Account\AccountStatus::ACTIVE; ?>"<?= $account->getStatus() === \phpOMS\Account\AccountStatus::ACTIVE ? ' selected' : ''; ?>><?= $this->getText('Active') ?>
                                    <option value="<?= \phpOMS\Account\AccountStatus::INACTIVE; ?>"<?= $account->getStatus() === \phpOMS\Account\AccountStatus::INACTIVE ? ' selected' : ''; ?>><?= $this->getText('Inactive') ?>
                                    <option value="<?= \phpOMS\Account\AccountStatus::TIMEOUT; ?>"<?= $account->getStatus() === \phpOMS\Account\AccountStatus::TIMEOUT ? ' selected' : ''; ?>><?= $this->getText('Timeout') ?>
                                    <option value="<?= \phpOMS\Account\AccountStatus::BANNED; ?>"<?= $account->getStatus() === \phpOMS\Account\AccountStatus::BANNED ? ' selected' : ''; ?>><?= $this->getText('Banned') ?>
                                </select>
                        <tr><td><label for="iUsername"><?= $this->getText('Username') ?></label>
                        <tr><td><input id="iUsername" name="name" type="text" placeholder="&#xf007; Fred" value="<?= $account->getName(); ?>" disabled>
                        <tr><td><label for="iName1"><?= $this->getText('Name1') ?></label>
                        <tr><td><input id="iName1" name="name1" type="text" placeholder="&#xf007; Donald" value="<?= $account->getName1(); ?>" required>
                        <tr><td><label for="iName2"><?= $this->getText('Name2') ?></label>
                        <tr><td><input id="iName2" name="name2" type="text" placeholder="&#xf007; Fauntleroy" value="<?= $account->getName2(); ?>">
                        <tr><td><label for="iName3"><?= $this->getText('Name3') ?></label>
                        <tr><td><input id="iName3" name="name3" type="text" placeholder="&#xf007; Duck" value="<?= $account->getName3(); ?>">
                        <tr><td><label for="iEmail"><?= $this->getText('Email') ?></label>
                        <tr><td><input id="iEmail" name="email" type="email" placeholder="&#xf0e0; d.duck@duckburg.com" value="<?= $account->getEmail(); ?>">
                        <tr><td><label for="iPassword"><?= $this->getText('Name3') ?></label>
                        <tr><td><input id="iPassword" name="password" type="text" placeholder="&#xf023; Pa55ssw0rd?">
                        <tr><td><input type="submit" value="<?= $this->getText('Save', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Groups') ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iGroup"><?= $this->getText('Name') ?></label>
                        <tr><td><input id="iGroup" name="group" type="text" placeholder="&#xf0c0; Guest">
                        <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Permissions') ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iGroup"><?= $this->getText('Name') ?></label>
                        <tr><td><input id="iGroup" name="group" type="text" placeholder="&#xf084; news_create">
                        <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>