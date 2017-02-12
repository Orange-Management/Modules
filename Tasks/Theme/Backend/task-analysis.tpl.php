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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Account'); ?></h1></header>
            <div class="inner">
                <form>
                    <table class="layout wf-100">
                        <tr><td><label for="iAccount"><?= $this->getText('Account'); ?></label>
                        <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="number" min="1" id="iAccount" name="account" placeholder="&#xf007; Guest" required></span>
                        <tr><td><label for="iFrom"><?= $this->getText('From'); ?></label>
                        <tr><td><input type="datetime-local" id="iFrom" name="from" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                        <tr><td><label for="iTo"><?= $this->getText('To'); ?></label>
                        <tr><td><input type="datetime-local" id="iTo" name="to" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                        <tr><td><input type="submit" value="<?= $this->getText('Submit', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Statistics'); ?></h1></header>
            <div class="inner">
                <table class="list wf-100">
                    <tr><td><?= $this->getText('Received'); ?><td>0
                    <tr><td><?= $this->getText('Created'); ?><td>0
                    <tr><td><?= $this->getText('Forwarded'); ?><td>0
                    <tr><td><?= $this->getText('AverageAmount'); ?><td>0
                    <tr><td><?= $this->getText('AverageProcessTime'); ?><td>0
                    <tr><td><?= $this->getText('InTime'); ?><td>0
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= $this->getText('History'); ?></h1></header>
            <div class="inner" style="height: 300px">
            </div>
        </section>
    </div>
</div>
