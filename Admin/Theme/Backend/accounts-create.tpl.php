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
echo $this->getData('nav')->render(); ?>

<section class="box w-33 floatLeft">
    <h1><?= $this->l11n->lang['Admin']['Account'] ?></h1>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/account'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iType"><?= $this->l11n->lang['Admin']['Type'] ?></label>
                <tr><td><select id="iType" name="type">
                            <option><?= $this->l11n->lang['Admin']['Person'] ?>
                            <option><?= $this->l11n->lang['Admin']['Organization'] ?>
                        </select>
                <tr><td><label for="iStatus"><?= $this->l11n->lang['Admin']['Status'] ?></label>
                <tr><td><select id="iStatus" name="status">
                            <option><?= $this->l11n->lang['Admin']['Active'] ?>
                            <option><?= $this->l11n->lang['Admin']['Inactive'] ?>
                            <option><?= $this->l11n->lang['Admin']['Timeout'] ?>
                            <option><?= $this->l11n->lang['Admin']['Banned'] ?>
                        </select>
                <tr><td><label for="iUsername"><?= $this->l11n->lang['Admin']['Username'] ?></label>
                <tr><td><input id="iUsername" name="name" type="text" placeholder="&#xf007; Fred">
                <tr><td><label for="iName1"><?= $this->l11n->lang['Admin']['Name1'] ?></label>
                <tr><td><input id="iName1" name="name1" type="text" placeholder="&#xf007; Donald" required>
                <tr><td><label for="iName2"><?= $this->l11n->lang['Admin']['Name2'] ?></label>
                <tr><td><input id="iName2" name="name2" type="text" placeholder="&#xf007; Fauntleroy">
                <tr><td><label for="iName3"><?= $this->l11n->lang['Admin']['Name3'] ?></label>
                <tr><td><input id="iName3" name="name3" type="text" placeholder="&#xf007; Duck">
                <tr><td><label for="iEmail"><?= $this->l11n->lang['Admin']['Email'] ?></label>
                <tr><td><input id="iEmail" name="email" type="email" placeholder="&#xf0e0; d.duck@duckburg.com">
                <tr><td><label for="iPassword"><?= $this->l11n->lang['Admin']['Name3'] ?></label>
                <tr><td><input id="iPassword" name="password" type="text" placeholder="&#xf023; Pa55ssw0rd?">
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Create'] ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-66 floatLeft">
    <h1><?= $this->l11n->lang['Admin']['Groups'] ?></h1>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGroup"><?= $this->l11n->lang['Admin']['Name'] ?></label>
                <tr><td><input id="iGroup" name="group" type="text" placeholder="&#xf0c0; Guest">
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-66 floatLeft">
    <h1><?= $this->l11n->lang['Admin']['Permissions'] ?></h1>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGroup"><?= $this->l11n->lang['Admin']['Name'] ?></label>
                <tr><td><input id="iGroup" name="group" type="text" placeholder="&#xf084; news_create">
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
            </table>
        </form>
    </div>
</section>
