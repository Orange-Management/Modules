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
    <header><h1><?= $this->getText('General'); ?></h1></header>
    <div class="inner">
        <form id="fChecklist">
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->getText('Name'); ?></label><td>
                <tr><td><input type="text" id="iName" name="name" required><td>
                <tr><td><label for="iDescription"><?= $this->getText('Description'); ?></label><td>
                <tr><td><textarea id="iDescription" name="description"></textarea><td>
                <tr><td><label for="iPermission"><?= $this->getText('Permissions'); ?></label><td>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button>
                            <input type="text" id="iPermission" name="permission"></span>
                    <td><button><?= $this->getText('Add'); ?></button>
                <tr><td><label for="iFiles"><?= $this->getText('Files'); ?></label><td>
                <tr><td><input id="iFiles" name="files" type="file" multiple><td>
                <tr><td><input type="submit" value="<?= $this->getText('Create'); ?>"><td>
            </table>
        </form>
    </div>
</section>

<section class="box w-33">
    <header><h1><?= $this->getText('Tasks'); ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iETitle"><?= $this->getText('Title'); ?></label><td>
                <tr><td><input type="text" id="iETitle" name="eTitle" required><td>
                <tr><td><label for="iEDescription"><?= $this->getText('Description'); ?></label><td>
                <tr><td><textarea id="iEDescription" name="eDescription"></textarea><td>
                <tr><td><label for="iETime"><?= $this->getText('TimeInMinutes'); ?></label><td>
                <tr><td><input type="number" min="0" step="1" id="iETime" name="eTime" value="0"><td>
                <tr><td><label for="iEPermission"><?= $this->getText('Permissions'); ?></label><td>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button>
                            <input type="text" id="iEPermission" name="ePermission"></span>
                    <td><button data-action=""><?= $this->getText('Add'); ?></button>
                <tr><td><label for="iEFiles"><?= $this->getText('Files'); ?></label><td>
                <tr><td><input id="iEFiles" name="eFiles" type="file" multiple><td>
                <tr><td><input type="submit" value="<?= $this->getText('Add'); ?>" data-action=""><td>
            </table>
        </form>
    </div>
</section>
