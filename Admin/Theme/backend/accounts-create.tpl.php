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
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
echo $this->getData('nav')->render(); ?>

<section class="box w-66 floatLeft">
    <header><h1><?= $this->getText('Account') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/account'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iType"><?= $this->getText('Type') ?></label>
                <tr><td><select id="iType" name="type">
                            <option><?= $this->getText('Person') ?>
                            <option><?= $this->getText('Organization') ?>
                        </select>
                <tr><td><label for="iStatus"><?= $this->getText('Status') ?></label>
                <tr><td><select id="iStatus" name="status">
                            <option><?= $this->getText('Active') ?>
                            <option><?= $this->getText('Inactive') ?>
                            <option><?= $this->getText('Timeout') ?>
                            <option><?= $this->getText('Banned') ?>
                        </select>
                <tr><td><label for="iUsername"><?= $this->getText('Username') ?></label>
                <tr><td><input id="iUsername" name="name" type="text" placeholder="&#xf007; Fred">
                <tr><td><label for="iName1"><?= $this->getText('Name1') ?></label>
                <tr><td><input id="iName1" name="name1" type="text" placeholder="&#xf007; Donald" required>
                <tr><td><label for="iName2"><?= $this->getText('Name2') ?></label>
                <tr><td><input id="iName2" name="name2" type="text" placeholder="&#xf007; Fauntleroy">
                <tr><td><label for="iName3"><?= $this->getText('Name3') ?></label>
                <tr><td><input id="iName3" name="name3" type="text" placeholder="&#xf007; Duck">
                <tr><td><label for="iEmail"><?= $this->getText('Email') ?></label>
                <tr><td><input id="iEmail" name="email" type="email" placeholder="&#xf0e0; d.duck@duckburg.com">
                <tr><td><label for="iPassword"><?= $this->getText('Name3') ?></label>
                <tr><td><input id="iPassword" name="password" type="text" placeholder="&#xf023; Pa55ssw0rd?">
                <tr><td><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Groups') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGroup"><?= $this->getText('Name') ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iGroup" name="group" type="text" placeholder="&#xf0c0; Guest" required></span>
                <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Permissions') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGroup"><?= $this->getText('Name') ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iGroup" name="group" type="text" placeholder="&#xf084; news_create" required></span>
                <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
            </table>
        </form>
    </div>
</section>
