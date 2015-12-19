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
/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render(); ?>

<section class="box w-33">
    <h1><?= $this->l11n->lang['Checklist']['General']; ?></h1>
    <div class="inner">
        <form id="fChecklist">
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->l11n->lang['Checklist']['Name']; ?></label><td>
                <tr><td><input type="text" id="iName" name="name" required><td>
                <tr><td><label for="iDescription"><?= $this->l11n->lang['Checklist']['Description']; ?></label><td>
                <tr><td><textarea id="iDescription" name="description"></textarea><td>
                <tr><td><label for="iPermission"><?= $this->l11n->lang['Checklist']['Permissions']; ?></label><td>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iPermission" name="permission"></span><td><button><?= $this->l11n->lang[0]['Add']; ?></button>
                <tr><td><label for="iFiles"><?= $this->l11n->lang['Checklist']['Files']; ?></label><td>
                <tr><td><input id="iFiles" name="files" type="file" multiple><td>
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Create']; ?>"><td>
            </table>
        </form>
    </div>
</section>

<section class="box w-33">
    <h1><?= $this->l11n->lang['Checklist']['Tasks']; ?></h1>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iETitle"><?= $this->l11n->lang['Checklist']['Title']; ?></label><td>
                <tr><td><input type="text" id="iETitle" name="eTitle" required><td>
                <tr><td><label for="iEDescription"><?= $this->l11n->lang['Checklist']['Description']; ?></label><td>
                <tr><td><textarea id="iEDescription" name="eDescription"></textarea><td>
                <tr><td><label for="iEPermission"><?= $this->l11n->lang['Checklist']['Permissions']; ?></label><td>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iEPermission" name="ePermission"></span><td><button><?= $this->l11n->lang[0]['Add']; ?></button>
                <tr><td><label for="iEFiles"><?= $this->l11n->lang['Checklist']['Files']; ?></label><td>
                <tr><td><input id="iEFiles" name="eFiles" type="file" multiple><td>
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Add']; ?>"><td>
            </table>
        </form>
    </div>
</section>
