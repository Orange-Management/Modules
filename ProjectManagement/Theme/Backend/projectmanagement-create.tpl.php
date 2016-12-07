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

<section class="box w-50">
    <header><h1><?= $this->getText('Project'); ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td colspan="3"><label for="iName"><?= $this->getText('Name'); ?></label>
                <tr><td colspan="2"><input type="text" id="iName" name="name" placeholder="" required><td>
                <tr><td colspan="3"><label for="iDescription"><?= $this->getText('Description'); ?></label>
                <tr><td colspan="2"><textarea id="iDescription" name="description"></textarea><td>
                <tr><td colspan="3"><label for="iStatus"><?= $this->getText('Status'); ?></label>
                <tr><td colspan="2"><select id="iStatus" name="status">
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::ACTIVE ?>"><?= $this->getText('Active'); ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::INACTIVE ?>"><?= $this->getText('Inactive'); ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::FINISHED ?>"><?= $this->getText('Finished'); ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::CANCELED ?>"><?= $this->getText('Canceled'); ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::HOLD ?>"><?= $this->getText('Hold'); ?>
                        </select><td>
                <tr><td colspan="3"><label for="iFiles"><?= $this->getText('Files'); ?></label>
                <tr><td colspan="2"><input type="file" id="iFiles" name="file" multiple><td>
                <tr><td colspan="3"><label for="iBudget"><?= $this->getText('Budget'); ?></label>
                <tr><td colspan="2"><input type="text" id="iBudget" name="budget" placeholder=""><td>
                <tr><td><label for="iDue"><?= $this->getText('Start'); ?></label><td><label for="iDue"><?= $this->getText('Due'); ?></label><td>
                <tr><td><input type="datetime-local" id="iDue" name="due"><td><input type="datetime-local" id="iDue" name="due"><td>
                <tr><td><label for="iResponsibility"><?= $this->getText('Responsibility'); ?></label><td><label for="iUser"><?= $this->getText('UserGroup'); ?></label><td>
                <tr><td><select id="iStatus" name="status">
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectResponsibility::MANAGER ?>"><?= $this->getText('Manager'); ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectResponsibility::OTHER ?>"><?= $this->getText('Other'); ?>
                        </select>
                    <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iUser" name="user" placeholder=""></span><td><button><?= $this->getText('Add', 0, 0); ?></button>
                <tr><td colspan="3"><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
            </table>
        </form>
    </div>
</section>
