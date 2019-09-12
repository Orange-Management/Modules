<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   TBD
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
/**
 * @var \phpOMS\Views\View $this
 */

$footerView = new \phpOMS\Views\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(0 / 25);
$footerView->setPage(1);
$footerView->setResults(0);

echo $this->getData('nav')->render(); ?>

<div class="box w-100">
    <table class="default">
        <caption><?= $this->getHtml('Arrivals') ?><i class="fa fa-download floatRight download btn"></i></caption>
        <thead>
        <tr>
            <td><?= $this->getHtml('ID', '0', '0'); ?>
            <td><?= $this->getHtml('AccountID') ?>
            <td class="wf-100"><?= $this->getHtml('Company') ?>
            <td><?= $this->getHtml('Creator') ?>
            <td><?= $this->getHtml('Created') ?>
        <tfoot>
        <tr><td colspan="4">
        <tbody>
        <?php if (0 == 0) : ?>
        <tr class="empty"><td colspan="5"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
                <?php foreach ([] as $key => $template) :
                $url = \phpOMS\Uri\UriFactory::build('{/prefix}helper/report/view?{?}&id=' . $template->getId()); ?>
        <tr>
            <td>
                <?php endforeach; ?>
    </table>
</div>
