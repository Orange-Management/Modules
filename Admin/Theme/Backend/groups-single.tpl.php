<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/*
 * UI Logic
 */

$group = $this->getData('group');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Group'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/group'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iGid"><?= $this->getHtml('ID', 0, 0); ?></label>
                        <tr><td><input id="iGid" name="gid" type="text" value="<?= htmlspecialchars($group->getId(), ENT_COMPAT, 'utf-8'); ?>" disabled>
                        <tr><td><label for="iGname"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><input id="iGname" name="gname" type="text" placeholder="&#xf0c0; Guest" value="<?= htmlspecialchars($group->getName(), ENT_COMPAT, 'utf-8'); ?>">
                        <tr><td><label for="iGroupDescription"><?= $this->getHtml('Description'); ?></label>
                        <tr><td><textarea id="iGroupDescription" name="description" placeholder="&#xf040;"><?= htmlspecialchars($group->getDescription(), ENT_COMPAT, 'utf-8'); ?></textarea>
                        <tr><td><input type="submit" value="<?= $this->getHtml('Create', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Parent'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/group'); ?>" method="post">
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
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Permissions'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/group'); ?>" method="post">
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
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/group'); ?>" method="post">
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