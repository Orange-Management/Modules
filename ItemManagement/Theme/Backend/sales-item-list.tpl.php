<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\ItemManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);


$footerView   = new \phpOMS\Views\PaginationView($this->l11nManager, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

$items = $this->getData('items');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="default">
                <caption><?= $this->getHtml('Items'); ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                    <td><?= $this->getHtml('Price') ?>
                    <td><?= $this->getHtml('Available') ?>
                    <td><?= $this->getHtml('Reserved') ?>
                    <td><?= $this->getHtml('Ordered') ?>
                <tfoot>
                <tr>
                    <td colspan="6">
                <tbody>
                <?php $count = 0; foreach ($items as $key => $value) : ++$count;
                $url = \phpOMS\Uri\UriFactory::build('{/prefix}sales/item/single?{?}&id=' . $value->getId()); ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getNumber()); ?></a>
                    <td>
                    <td>
                    <td>
                    <td>
                    <td>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
