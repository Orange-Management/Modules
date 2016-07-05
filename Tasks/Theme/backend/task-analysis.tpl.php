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

<section class="box w-50 floatLeft">
    <header><h1><?= $this->l11n->getText('Tasks', 'Backend', 'Account'); ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iAccount"><?= $this->l11n->getText('Tasks', 'Backend', 'Account'); ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="number" min="1" id="iAccount" name="account" placeholder="&#xf007; Guest" required></span>
                <tr><td><label for="iFrom"><?= $this->l11n->getText('Tasks', 'Backend', 'From'); ?></label>
                <tr><td><input type="datetime-local" id="iFrom" name="from" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                <tr><td><label for="iTo"><?= $this->l11n->getText('Tasks', 'Backend', 'To'); ?></label>
                <tr><td><input type="datetime-local" id="iTo" name="to" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Backend', 'Submit'); ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-50 floatLeft">
    <header><h1><?= $this->l11n->getText('Tasks', 'Backend', 'Statistics'); ?></h1></header>
    <div class="inner">
        <table class="list wf-100">
            <tr><td><?= $this->l11n->getText('Tasks', 'Backend', 'Received'); ?><td>0
            <tr><td><?= $this->l11n->getText('Tasks', 'Backend', 'Created'); ?><td>0
            <tr><td><?= $this->l11n->getText('Tasks', 'Backend', 'Forwarded'); ?><td>0
            <tr><td><?= $this->l11n->getText('Tasks', 'Backend', 'AverageAmount'); ?><td>0
            <tr><td><?= $this->l11n->getText('Tasks', 'Backend', 'AverageProcessTime'); ?><td>0
            <tr><td><?= $this->l11n->getText('Tasks', 'Backend', 'InTime'); ?><td>0
        </table>
    </div>
</section>
