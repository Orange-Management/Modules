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
/**
 * @var \phpOMS\Views\View $this
 */

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(0 / 25);
$footerView->setPage(1);
$footerView->setResults(0);

echo $this->getData('nav')->render(); ?>

<div class="box w-100">
    <table class="table red">
        <caption><?= $this->getText('Arrivals'); ?></caption>
        <thead>
        <tr>
            <td><?= $this->getText('ID', 0, 0); ?>
            <td><?= $this->getText('AccountID'); ?>
            <td class="wf-100"><?= $this->getText('Company'); ?>
            <td><?= $this->getText('Creator'); ?>
            <td><?= $this->getText('Created'); ?>
        <tfoot>
        <tr><td colspan="4"><?= $footerView->render(); ?>
        <tbody>
        <?php if(0 == 0) : ?>
        <tr class="empty"><td colspan="5"><?= $this->getText('Empty', 0, 0); ?>
                <?php endif; ?>
                <?php foreach ([] as $key => $template) :
                $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/reporter/report/view?{?}&id=' . $template->getId()); ?>
        <tr>
            <td>
                <?php endforeach; ?>
    </table>
</div>
