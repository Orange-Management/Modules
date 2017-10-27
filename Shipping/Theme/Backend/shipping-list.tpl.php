<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
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
    <table class="table red">
        <caption><?= $this->getHtml('Shipping') ?></caption>
        <thead>
        <tr>
            <td><?= $this->getHtml('ID', 0, 0); ?>
            <td><?= $this->getHtml('Reference') ?>
            <td><?= $this->getHtml('Status') ?>
            <td><?= $this->getHtml('Service') ?>
            <td class="wf-100"><?= $this->getHtml('Name') ?>
            <td><?= $this->getHtml('Creator') ?>
            <td><?= $this->getHtml('Created') ?>
        <tfoot>
        <tr><td colspan="7"><?= $footerView->render(); ?>
        <tbody>
        <?php $c = 0; foreach ([] as $key => $value) : $c++;
        $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/checklist/single?{?}&id=' . $value->getId()); ?>
        <tr>
            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getParent()); ?></a>
            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getUnit()); ?></a>
                <?php endforeach; ?>
                <?php if ($c === 0) : ?>
        <tr>
            <td colspan=7" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
    </table>
</div>
