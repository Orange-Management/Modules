<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

$footerView   = new \phpOMS\Views\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table darkred">
                <caption><?= $this->getHtml('Invoices'); ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', 0, 0); ?>
                    <td><?= $this->getHtml('Type') ?>
                    <td><?= $this->getHtml('ClientID') ?>
                    <td class="wf-100"><?= $this->getHtml('Client') ?>
                    <td><?= $this->getHtml('Net') ?>
                    <td><?= $this->getHtml('Gross') ?>
                    <td><?= $this->getHtml('Created') ?>
                    <td><?= $this->getHtml('Due') ?>
                <tfoot>
                <tr>
                    <td colspan="8">
                <tbody>
                <?php $count = 0; foreach ([] as $key => $value) : $count++; ?>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                <tr><td colspan="8" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>

