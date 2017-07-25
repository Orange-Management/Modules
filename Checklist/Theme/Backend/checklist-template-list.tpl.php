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
                <caption><?= $this->getHtml('Templates') ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', 0, 0); ?>
                    <td><?= $this->getHtml('Status') ?>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                    <td><?= $this->getHtml('Creator') ?>
                    <td><?= $this->getHtml('Created') ?>
                <tfoot>
                <tr><td colspan="5"><?= $footerView->render(); ?>
                <tbody>
                <?php $c = 0; foreach ([] as $key => $value) : $c++;
                $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/checklist/single?{?}&id=' . $value->getId()); ?>
                <tr>
                    <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getId(), ENT_COMPAT, 'utf-8'); ?></a>
                    <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getName(), ENT_COMPAT, 'utf-8'); ?></a>
                    <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getParent(), ENT_COMPAT, 'utf-8'); ?></a>
                    <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getUnit(), ENT_COMPAT, 'utf-8'); ?></a>
                        <?php endforeach; ?>
                        <?php if($c === 0) : ?>
                <tr>
                    <td colspan="5" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
