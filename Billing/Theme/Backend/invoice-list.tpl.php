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

<div class="box w-100">
    <table class="table">
        <caption><?= $this->getText('Invoices') ?></caption>
        <thead>
        <tr>
            <td><?= $this->getText('ID'); ?>
            <td><?= $this->getText('Type'); ?>
            <td><?= $this->getText('ClientID'); ?>
            <td class="wf-100"><?= $this->getText('Client'); ?>
            <td><?= $this->getText('Net'); ?>
            <td><?= $this->getText('Gross'); ?>
            <td><?= $this->getText('Created'); ?>
            <td><?= $this->getText('Due'); ?>
        <tfoot>
        <tr>
            <td colspan="8"><?= $footerView->render(); ?>
        <tbody>
        <?php $count = 0; foreach([] as $key => $value) : $count++; ?>
        <?php endforeach; ?>
        <?php if($count === 0) : ?>
        <tr><td colspan="8" class="empty"><?= $this->getText('Empty'); ?>
                <?php endif; ?>
    </table>
</div>
