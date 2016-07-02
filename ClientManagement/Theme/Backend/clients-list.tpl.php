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

$footerView   = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>

<!-- Hover may be better here?!?!?!
<section class="box w-100">
    <header><h1><?= $this->l11n->getText('ClientManagement', 'Client') ?></h1></header>
    <div class="inner floatLeft wf-100">
        <form class="wf-33 floatLeft">
            <table class="layout w-100">
                <tr><td><label for="iName1"><?= $this->l11n->getText('ClientManagement', 'Name1'); ?></label>
                <tr><td><input type="text" id="iName1" disabled>
                <tr><td><label for="iName2"><?= $this->l11n->getText('ClientManagement', 'Name2'); ?></label>
                <tr><td><input type="text" id="iName2" disabled>
                <tr><td><label for="iName3"><?= $this->l11n->getText('ClientManagement', 'Name3'); ?></label>
                <tr><td><input type="text" id="iName3" disabled>
            </table>
        </form>
        <form class="wf-33 floatLeft">
            <table class="layout w-100">
                <tr><td><label for="iAddress"><?= $this->l11n->getText('ClientManagement', 'Address'); ?></label>
                <tr><td><input type="text" id="iAddress" disabled>
                <tr><td><label for="iZip"><?= $this->l11n->getText('ClientManagement', 'Zip'); ?></label>
                <tr><td><input type="text" id="iZip" disabled>
                <tr><td><label for="iCountry"><?= $this->l11n->getText('ClientManagement', 'Country'); ?></label>
                <tr><td><input type="text" id="iCountry" disabled>
            </table>
        </form>
        <form class="wf-33 floatLeft">
            <table class="layout w-100">
                <tr><td><label for="iPhone"><?= $this->l11n->getText('ClientManagement', 'Phone'); ?></label>
                <tr><td><input type="text" id="iPhone" disabled>
                <tr><td><label for="iFax"><?= $this->l11n->getText('ClientManagement', 'Fax'); ?></label>
                <tr><td><input type="text" id="iFax" disabled>
                <tr><td><label for="iEmail"><?= $this->l11n->getText('ClientManagement', 'Email'); ?></label>
                <tr><td><input type="text" id="iEmail" disabled>
            </table>
        </form>
    </div>
</section>
-->

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->getText('ClientManagement', 'Clients') ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText(0, 'ID'); ?>
            <td><?= $this->l11n->getText('ClientManagement', 'Name1'); ?>
            <td><?= $this->l11n->getText('ClientManagement', 'Name2'); ?>
            <td class="wf-100"><?= $this->l11n->getText('ClientManagement', 'Name3'); ?>
            <td><?= $this->l11n->getText('ClientManagement', 'City'); ?>
            <td><?= $this->l11n->getText('ClientManagement', 'Zip'); ?>
            <td><?= $this->l11n->getText('ClientManagement', 'Address'); ?>
            <td><?= $this->l11n->getText('ClientManagement', 'Country'); ?>
        <tfoot>
        <tr>
            <td colspan="8"><?= $footerView->render(); ?>
        <tbody>
        <?php $count = 0; foreach([] as $key => $value) : $count++; ?>
        <?php endforeach; ?>
        <?php if($count === 0) : ?>
        <tr><td colspan="8" class="empty"><?= $this->l11n->getText(0, 'Empty'); ?>
                <?php endif; ?>
    </table>
</div>
