<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Marketing
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

$list = $this->getData('promotions');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="default">
                <caption><?= $this->getHtml('Promotions'); ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td class="wf-100"><?= $this->getHtml('Title') ?>
                    <td><?= $this->getHtml('Start') ?>
                    <td><?= $this->getHtml('Due') ?>
                <tfoot>
                <tr>
                    <td colspan="5">
                <tbody>
                <?php $count = 0; foreach ($list as $key => $value) : ++$count;
                $url = \phpOMS\Uri\UriFactory::build('{/prefix}marketing/promotion/profile?{?}&id=' . $value->getId());?>
                <tr data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('Title') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
                    <td data-label="<?= $this->getHtml('Start') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getStart()->format('Y-m-d')); ?></a>
                    <td data-label="<?= $this->getHtml('Due') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getEnd()->format('Y-m-d')); ?></a>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
