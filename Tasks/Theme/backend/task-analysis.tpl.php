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
    <h1><?= $this->l11n->lang['Tasks']['Account']; ?></h1>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iAccount"><?= $this->l11n->lang['Tasks']['Account']; ?></label>
                <tr><td><input type="text" id="iAccount" name="account" placeholder="">
                <tr><td><label for="iFrom"><?= $this->l11n->lang['Tasks']['From']; ?></label>
                <tr><td><input type="datetime-local" id="iFrom" name="from" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                <tr><td><label for="iTo"><?= $this->l11n->lang['Tasks']['To']; ?></label>
                <tr><td><input type="datetime-local" id="iTo" name="to" value="<?= (new \DateTime('NOW'))->format('Y-m-d\TH:i:s') ?>">
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Submit']; ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-50 floatLeft">
    <h1><?= $this->l11n->lang['Tasks']['Statistics']; ?></h1>
    <div class="inner">
        <table class="list wf-100">
            <tr><td><?= $this->l11n->lang['Tasks']['Received']; ?><td>0
            <tr><td><?= $this->l11n->lang['Tasks']['Created']; ?><td>0
            <tr><td><?= $this->l11n->lang['Tasks']['Forwarded']; ?><td>0
            <tr><td><?= $this->l11n->lang['Tasks']['AverageAmount']; ?><td>0
            <tr><td><?= $this->l11n->lang['Tasks']['AverageProcessTime']; ?><td>0
            <tr><td><?= $this->l11n->lang['Tasks']['InTime']; ?><td>0
        </table>
    </div>
</section>
