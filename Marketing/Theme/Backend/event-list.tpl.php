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

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getText('Events') ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getText('Status'); ?>
                    <td><?= $this->getText('Type'); ?>
                    <td class="wf-100"><?= $this->getText('Title'); ?>
                    <td><?= $this->getText('Start'); ?>
                    <td><?= $this->getText('End'); ?>
                    <td><?= $this->getText('Location'); ?>
                    <td><?= $this->getText('Expenses'); ?>
                    <td><?= $this->getText('Sales'); ?>
                    <td><?= $this->getText('Budget'); ?>
                <tfoot>
                <tr>
                    <td colspan="9"><?= $footerView->render(); ?>
                <tbody>
                <?php $count = 0; foreach([] as $key => $value) : $count++; ?>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
                <tr><td colspan="9" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
