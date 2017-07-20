<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */

$footerView   = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getText('Invoices') ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getText('ID', 0, 0); ?>
                    <td><?= $this->getText('Type'); ?>
                    <td><?= $this->getText('SupplierID'); ?>
                    <td class="wf-100"><?= $this->getText('Supplier'); ?>
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
                <tr><td colspan="8" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
