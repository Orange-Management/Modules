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

$footerView->setPages(1 / 25);
$footerView->setPage(1);
$footerView->setResults(1);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getText('Productions'); ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getText('Status'); ?>
                    <td><?= $this->getText('ID', 0, 0); ?>
                    <td><?= $this->getText('ID', 0, 0); ?>
                    <td class="wf-100"><?= $this->getText('Article'); ?>
                    <td><?= $this->getText('Quantity'); ?>
                    <td><?= $this->getText('Start'); ?>
                    <td><?= $this->getText('Due'); ?>
                    <td><?= $this->getText('Done'); ?>
                <tfoot>
                <tr><td colspan="8"><?= $footerView->render(); ?>
                <tbody>
                <?php $c = 0; foreach ([] as $key => $value) : $c++;
                $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/business/department/profile?{?}&id=' . $value->getId()); ?>
                <tr>
                    <td><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getName(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getParent(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getUnit(); ?></a>
                        <?php endforeach; ?>
                        <?php if($c === 0) : ?>
                <tr>
                    <td colspan="8" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>