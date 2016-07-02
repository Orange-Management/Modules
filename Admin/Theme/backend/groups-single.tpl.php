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
/*
 * UI Logic
 */

$group = $this->getData('group');

echo $this->getData('nav')->render(); ?>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->getText('Admin', 'Group') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGid"><?= $this->l11n->getText(0, 'ID') ?></label>
                <tr><td><input id="iGid" name="gid" type="text" value="<?= $group->getId(); ?>" disabled>
                <tr><td><label for="iGname"><?= $this->l11n->getText('Admin', 'Name') ?></label>
                <tr><td><input id="iGname" name="gname" type="text" placeholder="&#xf0c0; Guest" value="<?= $group->getName(); ?>">
                <tr><td><label for="iGroupDescription"><?= $this->l11n->getText('Admin', 'Description') ?></label>
                <tr><td><textarea id="iGroupDescription" name="description" placeholder="&#xf040;"><?= $group->getDescription(); ?></textarea>
                <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Create') ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->getText('Admin', 'Parent') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGParentName"><?= $this->l11n->getText('Admin', 'Name') ?></label>
                <tr><td><input id="iGParentName" name="parentname" type="text" placeholder="&#xf0c0; Guest">
                <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Add') ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->getText('Admin', 'Permissions') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iPermissionName"><?= $this->l11n->getText('Admin', 'Name') ?></label>
                <tr><td><input id="iPermissionName" name="permissionname" type="text" placeholder="&#xf084; Admin">
                <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Add') ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->getText('Admin', 'Accounts') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGParentName"><?= $this->l11n->getText('Admin', 'Name') ?></label>
                <tr><td><input id="iGParentName" name="parentname" type="text" placeholder="&#xf234; Donald Duck">
                <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Add') ?>">
            </table>
        </form>
    </div>
</section>


