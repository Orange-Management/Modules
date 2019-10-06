<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Comments
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View $this
 */

$footerView = new \phpOMS\Views\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>
<div class="box">
    <table class="default">
        <caption><?= $this->getHtml('Documents') ?><i class="fa fa-download floatRight download btn"></i></caption>
        <thead>
        <tr>
            <td class="wf-100"><?= $this->getHtml('Name') ?>
            <td><?= $this->getHtml('Creator') ?>
            <td><?= $this->getHtml('Created') ?>
        <tfoot>
        <tr>
            <td colspan="3">
        <tbody>
        <?php $count = 0; foreach ([] as $key => $value) : ++$count; ?>
        <?php endforeach; ?>
        <?php if ($count === 0) : ?>
        <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
    </table>
</div>
