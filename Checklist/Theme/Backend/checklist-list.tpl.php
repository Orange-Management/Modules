<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Checklist
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View $this
 */

$footerView = new \phpOMS\Views\PaginationView($this->l11nManager, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(25);
$footerView->setPage(1);
$footerView->setResults(1);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="default">
                <caption><?= $this->getHtml('Checklists') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td><?= $this->getHtml('Status') ?>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                    <td><?= $this->getHtml('Creator') ?>
                    <td><?= $this->getHtml('Created') ?>
                <tfoot>
                <tr><td colspan="5">
                <tbody>
                <?php $c = 0; foreach ([] as $key => $value) : ++$c;
                $url = \phpOMS\Uri\UriFactory::build('{/prefix}checklist/single?{?}&id=' . $value->getId()); ?>
                <tr>
                    <td data-label="<?= $this->getHtml('ID', '0', '0') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                    <td data-label="<?= $this->getHtml('Status') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
                    <td data-label="<?= $this->getHtml('Name') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getParent()); ?></a>
                    <td data-label="<?= $this->getHtml('Creator') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getUnit()); ?></a>
                    <td data-label="<?= $this->getHtml('Created') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getUnit()); ?></a>
                        <?php endforeach; ?>
                        <?php if ($c === 0) : ?>
                <tr>
                    <td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
