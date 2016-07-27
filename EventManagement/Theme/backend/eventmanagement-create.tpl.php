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

<section class="box w-50">
    <header><h1><?= $this->getText('Event'); ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td colspan="3"><label for="iName"><?= $this->getText('Name'); ?></label>
                <tr><td colspan="2"><input type="text" id="iName" name="name" placeholder="" required><td>
                <tr><td colspan="3"><label for="iDescription"><?= $this->getText('Description'); ?></label>
                <tr><td colspan="2"><textarea id="iDescription" name="description"></textarea><td>
                <tr><td colspan="3"><label for="iStatus"><?= $this->getText('Status'); ?></label>
                <tr><td colspan="2"><select id="iStatus" name="status">
                            <option value="">
                        </select><td>
                <tr><td colspan="3"><label for="iFiles"><?= $this->getText('Files'); ?></label>
                <tr><td colspan="2"><input type="file" id="iFiles" name="file" multiple><td>
                <tr><td><label for="iStart"><?= $this->getText('Start') ?><label><td><label for="iEnd"><?= $this->getText('End') ?><label><td>
                <tr><td><input type="datetime-local" id="iStart" name="start" required><td><input type="datetime-local" id="iEnd" name="end" required><td>
                <tr><td><label for="iResponsibility"><?= $this->getText('Responsibility'); ?></label><td><label for="iUser"><?= $this->getText('UserGroup'); ?></label><td>
                <tr><td><select id="iStatus" name="status">
                            <option value="">
                        </select>
                    <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iUser" name="user" placeholder=""></span><td><button><?= $this->getText('Add'); ?></button>
                <tr><td colspan="3"><input type="submit" value="<?= $this->getText('Create'); ?>">
            </table>
        </form>
    </div>
</section>
