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

echo $this->getData('nav')->render(); ?>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Group') ?></h1></header>
    <div class="inner">
        <form id="group-create" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="<?= \phpOMS\Message\Http\RequestMethod::PUT; ?>">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGname"><?= $this->getText('Name') ?></label>
                <tr><td><input id="iGname" name="gname" type="text" placeholder="&#xf0c0; Guest" required>
                <tr><td><label for="iGroupDescription"><?= $this->getText('Description') ?></label>
                <tr><td><textarea id="iGroupDescription" name="description" placeholder="&#xf040;"></textarea>
                <tr><td><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-66 floatLeft">
    <header><h1><?= $this->getText('Parent') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGParentName"><?= $this->getText('Name') ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iGParentName" name="parentname" type="text" placeholder="&#xf0c0; Guest" required></span>
                <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-66 floatLeft">
    <header><h1><?= $this->getText('Permissions') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iPermissionName"><?= $this->getText('Name') ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iPermissionName" name="permissionname" type="text" placeholder="&#xf084; Admin" required></span>
                <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
            </table>
        </form>
    </div>
</section>
