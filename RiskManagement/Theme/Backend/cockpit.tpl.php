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

<section class="wf-75 floatLeft">
    <div class="box w-100">
        <table class="table">
            <caption><?= $this->getText('TopRisks'); ?></caption>
            <thead>
            <tr>
                <td><?= $this->getText('Severity'); ?>
                <td class="wf-100"><?= $this->getText('Name'); ?>
                <td><?= $this->getText('Department'); ?>
                <td><?= $this->getText('Category'); ?>
                <td><?= $this->getText('Process'); ?>
                <td><?= $this->getText('Project'); ?>
            <tfoot>
            <tr><td colspan="6"><?= $footerView->render(); ?>
            <tbody>
            <?php $c = 0; foreach ([] as $key => $value) : $c++;
            $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/admin/group/settings?id=' . $value->getId()); ?>
            <tr>
                <td><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
                <td><a href="<?= $url; ?>"><?= $value->getName(); ?></a>
                <td>
                <td>
                <td>
                    <?php endforeach; ?>
                    <?php if($c === 0) : ?>
            <tr><td colspan="6" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                    <?php endif; ?>
        </table>
    </div>
</section>
<section class="wf-25 floatLeft">
    <section class="box w-100">
        <header><h1><?= $this->getText('Statistics'); ?></h1></header>
        <div class="inner">
            <table class="list">
                <thead>
                <tr>
                    <th><?= $this->getText('Risks'); ?>
                    <td>0
                <tr>
                    <th><?= $this->getText('Causes'); ?>
                    <td>0
                <tr>
                    <th><?= $this->getText('Solutions'); ?>
                    <td>0
                <tr>
                    <th><?= $this->getText('Department'); ?>
                    <td>0
                <tr>
                    <th><?= $this->getText('Category'); ?>
                    <td>0
                <tr>
                    <th><?= $this->getText('Process'); ?>
                    <td>0
                <tr>
                    <th><?= $this->getText('Project'); ?>
                    <td>0
                <tr>
                    <th><?= $this->getText('Total'); ?>
                    <td>0
            </table>
        </div>
    </section>
</section>
