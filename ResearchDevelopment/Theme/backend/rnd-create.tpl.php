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
    <header><h1><?= $this->l11n->lang['ResearchDevelopment']['Project']; ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td colspan="3"><label for="iName"><?= $this->l11n->lang['ResearchDevelopment']['Name']; ?></label>
                <tr><td colspan="2"><input type="text" id="iName" name="name" placeholder=""><td>
                <tr><td colspan="3"><label for="iDescription"><?= $this->l11n->lang['ResearchDevelopment']['Description']; ?></label>
                <tr><td colspan="2"><textarea id="iDescription" name="description"></textarea><td>
                <tr><td colspan="3"><label for="iStatus"><?= $this->l11n->lang['ResearchDevelopment']['Status']; ?></label>
                <tr><td colspan="2"><select id="iStatus" name="status">
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::ACTIVE ?>"><?= $this->l11n->lang['ResearchDevelopment']['Active']; ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::INACTIVE ?>"><?= $this->l11n->lang['ResearchDevelopment']['Inactive']; ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::FINISHED ?>"><?= $this->l11n->lang['ResearchDevelopment']['Finished']; ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::CANCELED ?>"><?= $this->l11n->lang['ResearchDevelopment']['Canceled']; ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectStatus::HOLD ?>"><?= $this->l11n->lang['ResearchDevelopment']['Hold']; ?>
                        </select><td>
                <tr><td colspan="3"><label for="iFiles"><?= $this->l11n->lang['ResearchDevelopment']['Files']; ?></label>
                <tr><td colspan="2"><input type="file" id="iFiles" name="file" multiple><td>
                <tr><td colspan="3"><label for="iBudget"><?= $this->l11n->lang['ResearchDevelopment']['Budget']; ?></label>
                <tr><td colspan="2"><input type="text" id="iBudget" name="budget" placeholder=""><td>
                <tr><td><label for="iDue"><?= $this->l11n->lang['ResearchDevelopment']['Start']; ?></label><td><label for="iDue"><?= $this->l11n->lang['ResearchDevelopment']['Due']; ?></label><td>
                <tr><td><input type="datetime-local" id="iDue" name="due"><td><input type="datetime-local" id="iDue" name="due"><td>
                <tr><td><label for="iResponsibility"><?= $this->l11n->lang['ResearchDevelopment']['Responsibility']; ?></label><td><label for="iUser"><?= $this->l11n->lang['ResearchDevelopment']['UserGroup']; ?></label><td>
                <tr><td><select id="iStatus" name="status">
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectResponsibility::MANAGER ?>"><?= $this->l11n->lang['ResearchDevelopment']['Manager']; ?>
                            <option value="<?= \Modules\ProjectManagement\Models\ProjectResponsibility::OTHER ?>"><?= $this->l11n->lang['ResearchDevelopment']['Other']; ?>
                        </select>
                    <td><input type="text" id="iUser" name="user" placeholder=""><td><button><?= $this->l11n->lang[0]['Add']; ?></button>
                <tr><td colspan="3"><input type="submit" value="<?= $this->l11n->lang[0]['Create']; ?>">
            </table>
        </form>
    </div>
</section>
