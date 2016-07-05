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
        <caption><?= $this->l11n->getText('ItemManagement', 'Backend', 'Items') ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText(0, 'Backend', 'ID'); ?>
            <td class="wf-100"><?= $this->l11n->getText('ItemManagement', 'Backend', 'Name'); ?>
            <td><?= $this->l11n->getText('ItemManagement', 'Backend', 'Price'); ?>
            <td><?= $this->l11n->getText('ItemManagement', 'Backend', 'Available'); ?>
            <td><?= $this->l11n->getText('ItemManagement', 'Backend', 'Reserved'); ?>
            <td><?= $this->l11n->getText('ItemManagement', 'Backend', 'Ordered'); ?>
        <tfoot>
        <tr>
            <td colspan="6"><?= $footerView->render(); ?>
        <tbody>
        <?php $count = 0; foreach([] as $key => $value) : $count++; ?>
        <?php endforeach; ?>
        <?php if($count === 0) : ?>
        <tr><td colspan="6" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
                <?php endif; ?>
    </table>
</div>
