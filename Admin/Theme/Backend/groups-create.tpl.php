<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/*
 * UI Logic
 */

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Group'); ?></h1></header>
            <div class="inner">
                <form id="group-create" action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/group'); ?>" method="<?= htmlspecialchars(\phpOMS\Message\Http\RequestMethod::PUT, ENT_COMPAT, 'utf-8'); ?>">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iStatus"><?= $this->getHtml('Status'); ?></label>
                        <tr><td colspan="2"><select id="iStatus" name="status">
                                    <option value="<?= htmlspecialchars(\phpOMS\Account\GroupStatus::ACTIVE, ENT_COMPAT, 'utf-8'); ?>" selected><?= $this->getHtml('Active'); ?>
                                    <option value="<?= htmlspecialchars(\phpOMS\Account\GroupStatus::INACTIVE, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('Inactive'); ?>
                        <tr><td><label for="iGname"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><input id="iGname" name="name" type="text" placeholder="&#xf0c0; Guest" required>
                        <tr><td><label for="iGroupDescription"><?= $this->getHtml('Description'); ?></label>
                        <tr><td><textarea id="iGroupDescription" name="description" placeholder="&#xf040;"></textarea>
                        <tr><td><input type="submit" value="<?= $this->getHtml('Create', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Parent'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/group'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iGParentName"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iGParentName" name="parentname" type="text" placeholder="&#xf0c0; Guest" required></span>
                        <tr><td><input type="submit" value="<?= $this->getHtml('Add', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Permissions'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/group'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iPermissionName"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iPermissionName" name="permissionname" type="text" placeholder="&#xf084; Admin" required></span>
                        <tr><td><input type="submit" value="<?= $this->getHtml('Add', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>