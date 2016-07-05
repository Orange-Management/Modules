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

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(1 / 25);
$footerView->setPage(1);
$footerView->setResults(1);

echo $this->getData('nav')->render(); ?>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->getText('AccountsReceivable', 'Backend', 'AccountsReceivable') ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText(0, 'Backend', 'ID'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Backend', 'Name1'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Backend', 'Name2'); ?>
            <td class="wf-100"><?= $this->l11n->getText('AccountsReceivable', 'Backend', 'Name3'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Backend', 'City'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Backend', 'Zip'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Backend', 'Address'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Backend', 'Country'); ?>
        <tfoot>
        <tr>
            <td colspan="8"><?= $footerView->render(); ?>
        <tbody>
        <?php $count = 0; foreach([] as $key => $value) : $count++; ?>
        <?php endforeach; ?>
        <?php if($count === 0) : ?>
        <tr><td colspan="8" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
                <?php endif; ?>
    </table>
</div>
