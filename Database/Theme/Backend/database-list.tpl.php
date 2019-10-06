<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Database
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View $this
 */

$queries      = [];
$footerView = new \phpOMS\Views\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(\count($queries) / 25);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="default">
                <caption><?= $this->getHtml('Templates') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                    <td><?= $this->getHtml('Creator') ?>
                    <td><?= $this->getHtml('Created') ?>
                        <tfoot>
                <tr>
                    <td colspan="3">
                        <tbody>
                        <?php $count = 0; foreach ($queries as $key => $value) : ++$count;
                        $url = \phpOMS\Uri\UriFactory::build('{/prefix}database/template/single?{?}&id=' . $value->getId()); ?>
                        <tr>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedBy()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedAt()->format('Y-m-d H:i:s')); ?></a>
                        <?php endforeach; ?>
                        <?php if ($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
