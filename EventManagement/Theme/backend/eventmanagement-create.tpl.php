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
    <header><h1><?= $this->l11n->getText('EventManagement', 'Backend', 'Event'); ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td colspan="3"><label for="iName"><?= $this->l11n->getText('EventManagement', 'Backend', 'Name'); ?></label>
                <tr><td colspan="2"><input type="text" id="iName" name="name" placeholder="" required><td>
                <tr><td colspan="3"><label for="iDescription"><?= $this->l11n->getText('EventManagement', 'Backend', 'Description'); ?></label>
                <tr><td colspan="2"><textarea id="iDescription" name="description"></textarea><td>
                <tr><td colspan="3"><label for="iStatus"><?= $this->l11n->getText('EventManagement', 'Backend', 'Status'); ?></label>
                <tr><td colspan="2"><select id="iStatus" name="status">
                            <option value="">
                        </select><td>
                <tr><td colspan="3"><label for="iFiles"><?= $this->l11n->getText('EventManagement', 'Backend', 'Files'); ?></label>
                <tr><td colspan="2"><input type="file" id="iFiles" name="file" multiple><td>
                <tr><td><label for="iStart"><?= $this->l11n->getText('EventManagement', 'Backend', 'Start') ?><label><td><label for="iEnd"><?= $this->l11n->getText('EventManagement', 'Backend', 'End') ?><label><td>
                <tr><td><input type="datetime-local" id="iStart" name="start" required><td><input type="datetime-local" id="iEnd" name="end" required><td>
                <tr><td><label for="iResponsibility"><?= $this->l11n->getText('EventManagement', 'Backend', 'Responsibility'); ?></label><td><label for="iUser"><?= $this->l11n->getText('EventManagement', 'Backend', 'UserGroup'); ?></label><td>
                <tr><td><select id="iStatus" name="status">
                            <option value="">
                        </select>
                    <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iUser" name="user" placeholder=""></span><td><button><?= $this->l11n->getText(0, 'Backend', 'Add'); ?></button>
                <tr><td colspan="3"><input type="submit" value="<?= $this->l11n->getText(0, 'Backend', 'Create'); ?>">
            </table>
        </form>
    </div>
</section>
