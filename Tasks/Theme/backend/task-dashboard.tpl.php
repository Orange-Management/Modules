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

<section class="box w-75 floatLeft">
    <table class="table">
        <caption><?= $this->l11n->lang['Tasks']['Tasks']; ?></caption>
        <thead>
            <tr><td><?= $this->l11n->lang[0]['ID']; ?>
            <td><?= $this->l11n->lang['Tasks']['Status']; ?>
            <td><?= $this->l11n->lang['Tasks']['Due']; ?>
            <td class="full"><?= $this->l11n->lang['Tasks']['Title']; ?>
            <td><?= $this->l11n->lang['Tasks']['Creator']; ?>
            <td><?= $this->l11n->lang['Tasks']['Created']; ?>
        <tfoot>
        <tbody>
        <tr><td colspan="6" class="empty"><?= $this->l11n->lang[0]['Empty']; ?>
    </table>
</section>

<section class="w-25 floatLeft">
    <section class="box w-100">
        <h1><?= $this->l11n->lang['Tasks']['Settings']; ?></h1>
        <div class="inner">
            <form>
                <table class="layout wf-100">
                    <tr><td><label for="iIntervarl"><?= $this->l11n->lang['Tasks']['Interval']; ?></label>
                    <tr><td><select id="iIntervarl" name="interval">
                                <option><?= $this->l11n->lang['Tasks']['All']; ?>
                                <option><?= $this->l11n->lang['Tasks']['Day']; ?>
                                <option><?= $this->l11n->lang['Tasks']['Week']; ?>
                                <option selected><?= $this->l11n->lang['Tasks']['Month']; ?>
                                <option><?= $this->l11n->lang['Tasks']['Year']; ?>
                            </select>
                </table>
            </form>
        </div>
    </section>

    <section class="box w-100">
        <h1><?= $this->l11n->lang['Tasks']['Settings']; ?></h1>
        <div class="inner">
            <table class="list">
                <tr><th><?= $this->l11n->lang['Tasks']['Received']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['Created']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['Forwarded']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['AverageAmount']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['AverageProcessTime']; ?><td>0
                <tr><th><?= $this->l11n->lang['Tasks']['InTime']; ?><td>0
            </table>
        </div>
    </section>
</section>
