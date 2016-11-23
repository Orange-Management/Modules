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

<div class="tabular-2">
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getText('Risk') ?></label>
            <li><label for="c-tab-2"><?= $this->getText('RiskObjects') ?></label>
            <li><label for="c-tab-3"><?= $this->getText('Solutions') ?></label>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <section class="box w-50 floatLeft">
                <header><h1><?= $this->getText('Risk'); ?></h1></header>

                <div class="inner">
                    <form id="fRisk"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/controlling/riskmanagement?csrf={$CSRF}'); ?>">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iName"><?= $this->getText('Name'); ?></label>
                            <tr><td><input type="text" id="iName" name="name" placeholder="&#xf040; <?= $this->getText('Name'); ?>" required>
                            <tr><td><label for="iDescription"><?= $this->getText('Description'); ?></label>
                            <tr><td><textarea id="iDescription" name="description"></textarea>
                            <tr><td><label for="iRiskConsequence"><?= $this->getText('RiskConsequence'); ?></label>
                            <tr><td><select id="iRiskConsequence" name="riskconsequence">

                                    </select>
                            <tr><td><label for="iRiskLikelihood"><?= $this->getText('RiskLikelihood'); ?></label>
                            <tr><td><select id="iRiskLikelihood" name="risklikelihood">

                                    </select>
                            <tr><td><label for="iCategory"><?= $this->getText('Category'); ?></label>
                            <tr><td><input type="text" id="iCategory" name="category" placeholder="&#xf040; <?= $this->getText('Category'); ?>">
                            <tr><td><label for="iDepartment"><?= $this->getText('Department'); ?></label>
                            <tr><td><input type="text" id="iDepartment" name="department" placeholder="&#xf040; <?= $this->getText('Department'); ?>">
                            <tr><td><label for="iProcess"><?= $this->getText('Process'); ?></label>
                            <tr><td><input type="text" id="iProcess" name="process" placeholder="&#xf040; <?= $this->getText('Process'); ?>">
                            <tr><td><label for="iProject"><?= $this->getText('Project'); ?></label>
                            <tr><td><input type="text" id="iProject" name="project" placeholder="&#xf040; <?= $this->getText('Project'); ?>">
                            <tr><td><label for="iReview"><?= $this->getText('Review'); ?></label>
                            <tr><td><input type="datetime-local" id="iReview" name="Review" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                            <tr><td><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <header><h1><?= $this->getText('Permissions'); ?></h1></header>

                <div class="inner">
                    <form>
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iResponsibility"><?= $this->getText('Responsibility'); ?></label><td><label for="iUser"><?= $this->getText('UserGroup'); ?></label><td>
                            <tr><td><select id="iStatus" name="status">
                                        <option value="">
                                    </select>
                                <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iUser" name="user" placeholder=""></span><td><button><?= $this->getText('Add', 0, 0); ?></button>
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
        </div>
        <input type="radio" id="c-tab-3" name="tabular-2">
        <div class="tab">
        </div>
    </div>
</div>